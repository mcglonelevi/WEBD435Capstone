@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>
    <div class="container product-display">
      <table class="listing">
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
                <td>
                  <input type="text" value="{{ $p['qty'] }}">
                </td>
                <td>
                  <a href="{{ url('/products/' . $p['product']->productCode . '/removefromcart') }}">Remove from Cart</a>
                </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      Subtotal: ${{number_format($subtotal, 2)}}
      <a href="/cart/create">Checkout</a>
    </div>
</div>
@endsection
