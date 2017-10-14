@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Order Details</h1>
            <table class="listing">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <!-- REMOVE INLINE STYLES -->s
                <tbody style="text-align: center;">
                    @foreach ($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->productName }}</td>
                            <td>{{ $detail->quantityOrdered }}</td>
                            <td>{{ $detail->priceEach }}</td>
                            <td>{{ $detail->subtotal() }}</td>
                            <td><a href="">Save</a>&nbsp;<a href="">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

    </div>

@endsection