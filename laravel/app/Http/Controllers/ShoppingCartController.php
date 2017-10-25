<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Order;
use App\OrderDetail;
use App\Payment;

class ShoppingCartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $request->session()->get('shopping_list', []);
        $subtotal = collect($products)->reduce(function ($carry, $i) {
          return $carry + ($i['qty'] * $i['product']->buyPrice);
        }, 0);
        return view('cart.index', compact('products', 'subtotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!$request->user()) {
            \Session::flash('status', 'You must login or register to continue with your order.');
            return redirect('/login');
        }
        $products = $request->session()->get('shopping_list', []);
        $subtotal = collect($products)->reduce(function ($carry, $i) {
          return $carry + ($i['qty'] * $i['product']->buyPrice);
        }, 0);
        return view('cart.create', compact('subtotal'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $shoppingList = $request->session()->get('shopping_list');
        if (count($shoppingList) == 0) {
            abort(403, 'You must have items in your shopping cart to checkout.');
        }

        $orderNumber = 0;

        while (Order::find($orderNumber)) {
          $orderNumber = mt_rand(0, 60000);
        }

        $payment = new Payment();
        $payment->customerNumber = $request->user()->customer->customerNumber;
        $payment->checkNumber = $request->input('checkNumber');
        $payment->paymentDate = Carbon::now();
        $payment->amount = collect($shoppingList)->reduce(function ($carry, $i) {
          return $carry + ($i['qty'] * $i['product']->buyPrice);
        }, 0);
        $payment->save();

        $order = new Order();
        $order->orderDate = Carbon::now();
        $order->status = Order::$STATUS_INPROCESS;
        $order->customerNumber = $request->user()->customer->customerNumber;
        $order->orderNumber = $orderNumber;
        $order->save();

        $counter = 1;

        foreach ($shoppingList as $p) {
          $orderDetail = new OrderDetail();
          $orderDetail->orderNumber = $orderNumber;
          $orderDetail->productCode = $p['product']->productCode;
          $orderDetail->quantityOrdered = $p['qty'];
          $orderDetail->priceEach = $p['product']->buyPrice;
          $orderDetail->orderLineNumber = $counter++;
          $orderDetail->save();

          $p['product']->quantityInStock = $p['product']->quantityInStock - $p['qty'];
          $p['product']->save();
        }

        $request->session()->put('shopping_list', []);

        return redirect()->action('HomeController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
