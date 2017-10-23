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
        <br>
        <p>
            {{ $product->productDescription }}
        </p>
        <br><br>
        <p>
            {{ $product->quantityInStock }} in stock
        </p>
        <br>
        <div class="grid">
            <div class="col-sm-10">
                ${{ $product->buyPrice }}
            </div>
            <input type="button" value="Add to Cart" />
        </div>
        <br>
        <br>

        <!-- Just an unncessary form to get a button to act like a link -->
        <form action="{{ url('products/' . $product->productCode . '/edit') }}">
            <input type="submit" value="Edit" />
        </form>

        {!! Form::model($product, ['route' => ['products.destroy', $product->productCode], 'method' => 'delete']) !!}
            {{ Form::submit('Delete :(') }}
        {!! Form::close() !!}
    </div>
</div>

<br><br><br>

<div class="grid col-sm-12 container">
    <div class="col-sm-1"></div>
    <h2 class="col-sm-11" style="font-size: 150%; font-weight: 500; padding-bottom: 10px">Related Products</h2>
    <div class="col-sm-12 grid">
    @foreach($relatedProducts as $p)
        <div class="col-sm-4" style="text-align: center;">
            <img src="http://via.placeholder.com/150x150" alt="placeholder">
            <br><br>
            <a href="{{ url('products/' . $p->productCode) }}" style="color: blue !important; text-decoration: underline;">{{ $p->productName }}</a>
            <br>
            ${{ $p->buyPrice }}
        </div>
    @endforeach
    </div>
</div>
<br><br>
@endsection
