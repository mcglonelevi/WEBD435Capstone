<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use Mail;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = Order::query();

        if ($request->input('search')) {
            $orders = $orders->join('customers', 'orders.customerNumber', '=', 'customers.customerNumber')
                        ->where('orders.orderNumber', '=', $request->input('search'))
                        ->orWhere('customers.customerName', 'like', '%' . $request->input('search') . '%')
                        ->select('orders.*');
        }

        $orders = $orders->paginate(10);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Order created in shopping cart
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Order stored by shopping cart
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Order $order)
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
    public function update(Request $request, Order $order)
    {
        $origStatus = $order->status;
        $order->fill($request->all());
        $order->save();

        $user = $order->customer->user;

        if ($order->status == "Shipped" && $order->status != $origStatus) {
          Mail::send('emails.ordershipped', compact('order'), function ($m) use ($user) {
              $m->from('lugnutzcp@gmail.com', 'Lugnutz Computer Parts');

              $m->to($user->email, $user->name)->subject('Your Order has been shipped!');
          });
        }

        return redirect()->action('OrdersController@show', [$order]);
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
