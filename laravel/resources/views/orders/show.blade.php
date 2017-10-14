@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Order Details</h1>
            <div class="container">
              <h1>Set Status</h1>
              {!! Form::open(['url' => route('orders.update', [
              $order->orderNumber
            ]), 'method' => 'put']) !!}
              {!! Form::select('status', $order->getStatuses(), $order->status) !!}
              {!! Form::submit('Save Status') !!}
              {!! Form::close() !!}
            </div>
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
                <!-- REMOVE INLINE STYLES -->
                <tbody style="text-align: center;">
                    @foreach ($order->orderDetails as $detail)
                        <tr>
                            <td>{{ $detail->product->productName }}</td>
                            <td>
                              {!!
                                Form::open(
                                ['url' => route('orders.orderdetails.update', [
                                $order->orderNumber,
                                $detail->id
                              ]), 'method' => 'put'])
                              !!}

                              {!! Form::number('quantityOrdered', $detail->quantityOrdered) !!}
                              {!! Form::submit('Save') !!}

                              {!! Form::close() !!}
                            </td>
                            <td>{{ $detail->priceEach }}</td>
                            <td>{{ $detail->subtotal() }}</td>
                            <td>
                              {!!
                                Form::open(
                                ['url' => route('orders.orderdetails.destroy', [
                                $order->orderNumber,
                                $detail->id
                              ]), 'method' => 'delete'])
                              !!}

                              {!! Form::submit('Delete') !!}

                              {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <h1>Total Price: ${{$order->getTotal()}}</h1>

            <h1>Add Item to Order</h1>
            {!!
              Form::open(
              ['url' => route('orders.orderdetails.store', [
              $order->orderNumber
            ]), 'method' => 'post'])
            !!}

            {!! Form::label('productCode', 'Product ID') !!}
            {!! Form::text('productCode', '') !!}
            {!! Form::label('quantity', 'Quantity') !!}
            {!! Form::number('quantity', 1) !!}
            {!! Form::submit('Add to Order') !!}

            {!! Form::close() !!}
    </div>

@endsection
