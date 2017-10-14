@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Orders</h1>
        <div class="container">
            {{ $orders->links() }}
        </div>
        <div class="container product-display">
            <table class="listing">
                <thead>
                    <tr>
                        <th>
                            Order Number
                        </th>
                        <th>
                            Customer
                        </th>
                        <th>
                             Date
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody style="text-align: center;">
                    @foreach($orders as $o)
                        <tr>
                            <td>
                                {{ $o->orderNumber }}
                            </td>
                            <td>
                                <a href="{{ url('/customers/' . $o->customerNumber) }}">
                                    {{ $o->customer->customerName }}
                                </a>
                            </td>
                            <td>
                                {{ $o->orderDate }}
                            </td>
                            <td>
                                {{ $o->getTotal() }}
                            </td>
                            <td>
                                <a href="{{ url('/orders/' . $o->orderNumber) }}">Edit</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="container">
            {{ $orders->links() }}
        </div>
    </div>
@endsection
