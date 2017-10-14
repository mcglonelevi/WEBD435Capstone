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
                <tbody>
                    @foreach ($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->productName }}</td>
                            <td>{{ $detail->quantityOrdered }}</td>
                            <td>{{ $detail->product->MSRP }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

    </div>

@endsection