@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>
    <div class="container">
        {{ $products->links() }}
    </div>
    <div class="container product-display">
      <table class="listing">
        @foreach($products as $p)
          <tr>
              <td>
                <img src="http://via.placeholder.com/50x50" alt="">
              </td>
              <td>
                <a href="{{ url('/products/' . $p->productCode) }}">{{$p->productName}}</a>
              </td>
              <td>
                <a href="{{ url('/products/' . $p->productCode . '/addtocart') }}">Add to Cart</a>
              </td>
          </tr>
        @endforeach
      </table>
    </div>
    <div class="container">
        {{ $products->links() }}
    </div>
</div>
@endsection
