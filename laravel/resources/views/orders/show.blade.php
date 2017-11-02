@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Order Details</h1>
            <div class="container">
              {!! Form::open(['url' => route('orders.update', [$order->orderNumber]), 'method' => 'put']) !!}
                <div class="form-group">
                  {!! Form::label('status', 'Set Order Status:', ['class' => 'control-label']) !!}
                  {!! Form::select('status', $order->getStatuses(), $order->status, array('class' => 'form-control') ) !!}
                </div>
                {!! Form::submit('Save Status', array('class' => 'btn btn-success btn-md')) !!}
              {!! Form::close() !!}
            </div>
            <br>
            <table class="table table-striped table-hover">
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
                            <td>
                              {!!
                                Form::open(
                                ['url' => route('orders.orderdetails.update', [
                                $order->orderNumber,
                                $detail->id
                              ]), 'method' => 'put'])
                              !!}

                              {!! Form::number('quantityOrdered', $detail->quantityOrdered, array('min' => '0') ) !!}
                              {!! Form::submit('Save', array('class' => 'btn btn-success btn-sm')) !!}

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

                              {!! Form::submit('Delete', array('class' => 'btn btn-danger btn-sm')) !!}

                              {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <h2>Total Price: ${{$order->getTotal()}}</h2>
            <br>
            <br>
            <div class="panel panel-default">
              <div class="panel-heading">
                Add Product to Order
              </div>
              <div class="panel-body">
                {!!
                  Form::open(
                  ['url' => route('orders.orderdetails.store', [
                  $order->orderNumber
                ]), 'method' => 'post'])
                !!}
                <div class="form-group">
                  {!! Form::label('productCode', 'Product ID', array('class' => 'control-label') ) !!}
                  {!! Form::text('productCode', '', array('class' => 'form-control')) !!}
                </div>
                <div class="form-group">
                  {!! Form::label('quantity', 'Quantity', array('class' => 'control-label') ) !!}
                  {!! Form::number('quantity', 1, array('class' => 'form-control', 'min' => '0') ) !!}
                  &emsp;<!-- Add a little space between button/input -->
                  {!! Form::submit('Add to Order', array('class' => 'btn btn-success btn-md')) !!}
                </div>
                <div class="form-group">
                  
                </div>
              </div>
            </div>
            {!! Form::close() !!}
    </div>

@endsection
