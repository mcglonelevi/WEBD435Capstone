@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>
    {!! Form::open(['route' => 'products.index', 'method' => 'get']) !!}
      <div class="grid">
        <div class="col-sm-4 form-group">
          {{ Form::text('search', null, array('placeholder' => 'Search products by name...', 'class' => 'form-control') ) }}
        </div>
        <div class="col-sm-2 form-group">
          {{ Form::select('category', array_merge([null => 'All Categories'], $categories->toArray()), null, ['class' => 'form-control']) }}
        </div>
        <div class="col-sm-4 form-group">
          {{ Form::submit('Search Products', [ 'class' => 'btn btn-primary btn-md' ]) }}
        </div>
        @if (Request::user() && Request::user()->is_admin)
          <div class="col-sm-2">
            <a href="{{ url('/products/create') }}" class="right btn btn-danger">Add New Product</a>
          </div>
        @endif
      </div>
    {!! Form::close() !!}
    <br>
    <div>
        {{ $products->links() }}
    </div>
    <div class="container product-display">
      <table class="products-table">
        @foreach($products as $p)
          <tr>
            <td class="img-cell">
              @if (!$p->image_url)
                  <img src="http://via.placeholder.com/125x125" alt="">
              @else
                  <img src="{{ asset($p->image_url) }}" width="125" alt="">
              @endif
            </td>
            <td>
              <h2>
                <a href="{{ url('/products/' . $p->productCode) }}">{{$p->productName}}</a>
              </h2>
              <b>{{ $p->quantityInStock }} in stock</b>
            </td>
            <td>
              <div class="price">${{ $p->buyPrice }}</div>
              {!! Form::open(['url' => url('/products/' . $p->productCode . '/addtocart'), 'method' => 'get', 'class' => 'bottom']); !!}
                {!! Form::label('qty', 'Quantity:', ['class' => 'product-qty']) !!}
                {!! Form::number('text', '1', [
                  'name'  => 'qty',
                  'style' => 'width: 75px; margin-right: 20px;',
                  'min'   => '1',
                ]); !!}
                {!! Form::submit('Add to Cart', ['class' => 'add-cart']); !!}
              {!! Form::close(); !!}
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
