@extends('layouts.app')

@section('content')

<div class="container">

@if (isset($product))
    <h1>Edit Product</h1>
    {!! Form::model($product, ['route' => ['products.update', $product->productCode], 'method' => 'put', 'enctype' => 'multipart/form-data']) !!}
@else
    <h1>Create New Product</h1>
    {!! Form::open(['action' => 'ProductsController@store', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
@endif
    <div class="form-group">
        {{ Form::label('productCode', 'Product Code', array('class' => 'control-label') ) }}
        {{ Form::text('productCode', null, array('placeholder' => 'Sxx_xxxx', 'required' => 'required', 'class' => 'form-control') ) }}
    </div>
    <div class="form-group">
        {{ Form::label('productName', 'Product Name', array('class' => 'control-label') ) }}
        {{ Form::text('productName', null, array('placeholder' => 'Product Name', 'required' => 'required', 'class' => 'form-control') ) }}
    </div>
    <div class="form-group">
        {{ Form::label('productLine', 'Product Line', array('class' => 'control-label') ) }}
        {{ Form::select('productLine', $productLines, null, array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
        {{ Form::label('productScale', 'Product Scale', array('class' => 'control-label') ) }}
        {{ Form::text('productScale', null, array('placeholder' => '1.25', 'required' => 'required', 'class' => 'form-control') ) }}
    </div>
    <div class="form-group">
        {{ Form::label('productVendor', 'Product Vendor', array('class' => 'control-label') ) }}
        {{ Form::text('productVendor', null, array('placeholder' => 'Product Vendor', 'required' => 'required', 'class' => 'form-control') ) }}
    </div>
    <div class="form-group">
        {{ Form::label('productDescription', 'Description', array('class' => 'control-label') ) }}
        {{ Form::textarea('productDescription', null, array('placeholder' => 'Product Description...', 'required' => 'required') ) }}
    </div>
    <div class="form-group">
        {{ Form::label('quantityInStock', 'Current Stock', array('class' => 'control-label') ) }}
        {{ Form::text('quantityInStock', null, array('placeholder' => '144', 'required' => 'required', 'class' => 'form-control') ) }}
    </div>
    <div class="form-group">
        {{ Form::label('buyPrice', 'Price', array('class' => 'control-label') ) }}
        {{ Form::text('buyPrice', null, array('placeholder' => '24.93', 'required' => 'required', 'class' => 'form-control') ) }}
    </div>
    <div class="form-group">
        {{ Form::label('MSRP', 'MSRP', array('class' => 'control-label') ) }}
        {{ Form::text('MSRP', null, array('placeholder' => '42.99', 'required' => 'required', 'class' => 'form-control') ) }}
    </div>
    <div class="form-group">
        {{ Form::label('image', 'Image Upload') }}
        {{ Form::file('image') }}
        @if (isset($product) && $product->image_url != null)
            <div class="">
            <img src="{{ asset($product->image_url) }}" width="300">
            </div>
        @endif
    </div>
    <br>
    <div class="form-group">
        @if (isset($product))
            {{ Form::submit('Update Product', array('class' => 'btn btn-success') ) }}
            {{ Form::reset('Reset Form', array('class' => 'btn btn-danger') ) }}
        @else
            {{ Form::submit('Create Product', array('class' => 'btn btn-success') ) }}
            {{ Form::reset('Reset Form', array('class' => 'btn btn-danger') ) }}
        @endif
    </div>

{!! Form::close() !!}

<br><br>
</div>
@endsection
