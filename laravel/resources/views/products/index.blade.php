@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>
    {!! Form::open(['route' => 'products.index', 'method' => 'get']) !!}
        <div class="grid">
          <div class="col-sm-4 form-group">
              {{ Form::text('search', null, array('placeholder' => 'Search products by name...') ) }}
          </div>
          <div class="col-sm-4 form-group">
              {{ Form::select('category', array_merge([null => 'All Categories'], $categories->toArray())) }}
          </div>
          <div class="col-sm-4 form-group">
              {{ Form::submit('Search Products') }}
          </div>
      </div>
    {!! Form::close() !!}
    <div class="container">
        {{ $products->links() }}
    </div>
    <div class="container product-display">
      <table class="listing">
        @foreach($products as $p)
          <tr>
              <td>
                @if (!$p->image_url)
                    <img src="http://via.placeholder.com/50x50" alt="">
                @else
                    <img src="{{ asset($p->image_url) }}" width="50" alt="">
                @endif
              </td>
              <td>
                <a href="{{ url('/products/' . $p->productCode) }}">{{$p->productName}}</a>
              </td>
              <td>
                {!! Form::open(['url' => url('/products/' . $p->productCode . '/addtocart'), 'method' => 'get']); !!}
                    {!! Form::label('qty', 'Quantity:') !!}
                    <div>
                      {!! Form::text('text', '1', [
                        'name' => 'qty',
                        'style' => 'width: 150px; float: left; margin-right: 20px;',
                      ]); !!}
                      {!! Form::submit('Add to Cart', ['class' => 'btn btn-success btn-sm']); !!}
                    </div>
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
