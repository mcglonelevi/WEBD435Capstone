@extends('layouts.app')

@section('content')

<div class="container">
<br>

@if (isset($product))
    {!! Form::model($product, ['route' => ['products.update', $product->productCode], 'method' => 'put']) !!}
@else
    {!! Form::open(['action' => 'ProductsController@store', 'method' => 'post']) !!}
@endif
    
    {{ Form::label('productCode', 'Product Code') }}
    {{ Form::text('productCode', null, array('placeholder' => 'Sxx_xxxx', 'required' => 'required') ) }}
    <br><br>
    {{ Form::label('productName', 'Product Name') }}
    {{ Form::text('productName', null, array('placeholder' => 'Product Name', 'required' => 'required') ) }}
    <br><br>
    {{ Form::label('productLine', 'Product Line') }}
    {{ Form::select('productLine', [
                                    'Classic Cars'     => 'Classic Cars', 
                                    'Motorcycles'      => 'Motorcycles',
                                    'Planes'           => 'Planes',
                                    'Ships'            => 'Ships',
                                    'Trains'           => 'Trains',
                                    'Trucks and Buses' => 'Trucks and Buses',
                                    'Vintage Cars'     => 'Vintage Cars',
                                    ]) 
    }}
    <br><br>
    {{ Form::label('productScale', 'Product Scale') }}
    {{ Form::text('productScale', null, array('placeholder' => '1.25', 'required' => 'required') ) }}
    <br><br>
    {{ Form::label('productVendor', 'Product Vendor') }}
    {{ Form::text('productVendor', null, array('placeholder' => 'Product Vendor', 'required' => 'required') ) }}
    <br><br>
    {{ Form::textarea('productDescription', null, array('placeholder' => 'Product Description...', 'required' => 'required') ) }}
    <br><br>
    {{ Form::label('quantityInStock', 'Current Stock') }}
    {{ Form::text('quantityInStock', null, array('placeholder' => '144', 'required' => 'required') ) }}
    <br><br>
    {{ Form::label('buyPrice', 'Price') }}
    {{ Form::text('buyPrice', null, array('placeholder' => '24.93', 'required' => 'required') ) }}
    <br><br>
    {{ Form::label('MSRP', 'MSRP') }}
    {{ Form::text('MSRP', null, array('placeholder' => '42.99', 'required' => 'required') ) }}
    <br><br>

    @if (isset($product))
        {{ Form::submit('Update Product') }}
    @else
        {{ Form::submit('Create Product') }}
    @endif

{!! Form::close() !!}

<br><br>
</div>
@endsection