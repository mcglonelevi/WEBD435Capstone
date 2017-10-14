<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
use App\OrderDetail;
use App\Product;
use Exception;

class OrderdetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Order $order)
    {
        $product = Product::where('productCode', $request->input('productCode'))->first();
        if (!$product) {
            throw new Exception('Product with this code is not found.');
        }
        $orderDetail = new OrderDetail();
        $orderDetail->orderNumber = $order->orderNumber;
        $orderDetail->productCode = $product->productCode;
        $orderDetail->priceEach = $product->buyPrice;
        $orderDetail->quantityOrdered = $request->input('quantity');
        $orderDetail->orderLineNumber = 1;
        $orderDetail->save();
        return redirect()->action('OrdersController@show', [$order]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order, OrderDetail $orderDetail)
    {
        $orderDetail->fill($request->all());
        $orderDetail->save();
        return redirect()->action('OrdersController@show', [$order]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order, OrderDetail $orderDetail)
    {
        $orderDetail->delete();
        return redirect()->action('OrdersController@show', [$order]);
    }
}
