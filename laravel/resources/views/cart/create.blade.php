@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>
    <div class="container product-display">
      Your total: <b>${{number_format($subtotal, 2)}}</b>
      <br><br>
      {!! Form::open(['action' => 'ShoppingCartController@store', 'method' => 'post']) !!}
        {{ Form::label('checkNumber', 'Check Number', array('class' => 'control-label') ) }}
        {{ Form::text('checkNumber', null, array('required' => 'required', 'class' => 'form-control') ) }}
        <br>
	@if ($user->customer->loyalty_points)
        <div style="margin: 10px 0;">
          {{ Form::checkbox('redeem_points', false) }} Redeem loyalty points? ({{ $user->customer->loyalty_points }} points available)
        </div>
        <br>
	@endif
        {{ Form::submit('Checkout', array('class' => 'btn btn-success') ) }}
      {!! Form::close() !!}
    </div>
</div>
@endsection
