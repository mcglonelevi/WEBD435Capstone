@extends('layouts.app')

@section('content')

<!-- This HTML is just to give an idea. It all will need edited/replaced when styles are created -->

<div class="grid container">
    <div class="col-sm-1"></div> <!-- Spacing -->
    <div class="col-sm-4">
        @if (!$product->image_url)
            <img src="http://via.placeholder.com/300x300" alt="">
        @else
            <img src="{{ asset($product->image_url) }}" width="300" alt="">
        @endif
    </div>
    <div class="col-sm-6">
        <h1 style="font-size: 200%; padding: 20px 20px 20px 0; font-weight: 500;">{{ $product->productName }}</h1>
        <p>
            {{ $product->productDescription }}
        </p>
        <br>
        <p>
            {{ $product->quantityInStock }} in stock
        </p>
        <br>
        <div class="grid">
            <div class="col-sm-9">
                <h2>${{ $product->buyPrice }}</h2>
            </div>
            <div class="col-sm-3">
              {!! Form::open(['url' => url('/products/' . $product->productCode . '/addtocart'), 'method' => 'get']); !!}
                  {!! Form::label('qty', 'Quantity:') !!}
                  <div>
                    {!! Form::text('text', '1', [
                      'name' => 'qty',
                      'style' => 'width: 150px; float: left; margin-right: 20px;',
                    ]); !!}
                    {!! Form::submit('Add to Cart', ['class' => 'btn btn-success btn-sm']); !!}
                  </div>
              {!! Form::close(); !!}
            </div>
        </div>
        <br>
        <br>
        <div class="fb-share-button"
              data-href="{{ Request::url() }}"
              data-layout="button_count" data-size="small"
              data-mobile-iframe="true">
              <a class="fb-xfbml-parse-ignore" target="_blank"
              href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(Request::url()) }}&amp;src=sdkpreparse">Share</a></div>

        <div style="margin-top: 10px;">
          <div class="fb-like" data-href="{{ Request::url() }}" data-layout="standard" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>
        </div>
        @if (isset($user) && $user->is_admin)
            <div class="right">
                <a href="{{ url('products/' . $product->productCode . '/edit') }}" class="btn btn-primary">Edit</a>

                {!! Form::model($product, ['route' => ['products.destroy', $product->productCode], 'method' => 'delete', 'class' => 'form-inline']) !!}
                    {{ Form::submit('Delete', array('class' => 'btn btn-danger') ) }}
                {!! Form::close() !!}
            </div>
        @endif
    </div>
</div>

<br><br><br>

<div class="grid col-sm-12 container">
    <div class="col-sm-1"></div>
    <h2 class="col-sm-11" style="font-size: 150%; font-weight: 500; padding-bottom: 10px">Related Products</h2>
    <div class="col-sm-12 grid">
    @foreach($relatedProducts as $p)
        <div class="col-sm-3" style="text-align: center;">
            <img src="http://via.placeholder.com/150x150" alt="placeholder">
            <br><br>
            <a href="{{ url('products/' . $p->productCode) }}" >{{ $p->productName }}</a>
            <br>
            <p>
                ${{ $p->buyPrice }}
            </p>
        </div>
    @endforeach
    </div>
</div>
<br><br>
@endsection
