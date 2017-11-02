@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Orders</h1>
        {!! Form::open(['route' => 'orders.index', 'method' => 'get']) !!}
        <div class="grid">
            <div class="col-sm-4 form-group">
                {{ Form::text('search', null, array('placeholder' => 'Search by order number or customer name...', 'class' => 'form-control') ) }}
            </div>
            <div class="col-sm-4 form-group">
                {{ Form::submit('Search Orders', ['class' => 'btn btn-primary btn-md']) }}
            </div>
            {!! Form::close() !!}
        </div>
        <br>
        <div class="container">
            {{ $orders->links() }}
        </div>
        <div class="container product-display">
            <table class="table table-striped">
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
