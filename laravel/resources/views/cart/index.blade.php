@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>
    <div class="container product-display">
      @if (count($products) > 0)
      <table class="cart-table">
        <thead>
          <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($products as $p)
            <tr>
                <td>
                  @if (!$p['product']->image_url)
                      <img src="http://via.placeholder.com/50x50" alt="">
                  @else
                      <img src="{{ asset($p['product']->image_url) }}" width="50" alt="">
                  @endif
                </td>
                <td>
                  <a href="{{ url('/products/' . $p['product']->productCode) }}">{{$p['product']->productName}}</a>
                </td>
                <td>
                  {{ $p['product']->buyPrice }}
                </td>
                <td class="update-qty">
                  <div style="width: 170px; display: inline-block;">
                    {!! Form::open(['url' => url('/products/' . $p['product']->productCode . '/addtocart'), 'method' => 'get']); !!}
                        {!! Form::number('text', $p['qty'], [
                          'name' => 'qty',
                          'style' => 'width: 100px; float: left;',
                          'min' => '0',
                        ]); !!}
                        {!! Form::submit('Update', ['class' => 'btn btn-success btn-sm']); !!}
                    {!! Form::close(); !!}
                  </div>
                </td>
                <td>
                  <a class="btn btn-danger" href="{{ url('/products/' . $p['product']->productCode . '/removefromcart') }}">Remove from Cart</a>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      <div>
          Subtotal: ${{number_format($subtotal, 2)}}
      </div>
      <div class="grid">
          <a href="/cart/create" class="btn btn-success">Checkout</a>
      </div>
      @else
        <div class="col-sm-12">
            There are no items in your shopping cart.
        </div>
      @endif
    </div>
</div>
@endsection
