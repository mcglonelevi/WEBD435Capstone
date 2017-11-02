@extends('layouts.app')

@section('content')

<div class="container">
        <h1>Customer Profile</h1>
        <h2>Loyalty Points: {{$customer->loyalty_points}}</h2>
        {!! Form::model($customer, ['route' => ['customers.update', $customer->customerNumber], 'method' => 'put']) !!}
        <div class="grid">
          <div class="col-sm-6 form-group">
              {{ Form::label('customerName', 'Customer Name') }}
              {{ Form::text('customerName', null, array('placeholder' => 'Customer Name', 'required' => 'required') ) }}
          </div>
          <div class="col-sm-6 form-group">
              {{ Form::label('phone', 'Customer Phone') }}
              {{ Form::text('phone', null, array('placeholder' => 'Phone', 'required' => 'required') ) }}
          </div>
          <div class="col-sm-6 form-group">
              {{ Form::label('addressLine1', 'Address Line 1') }}
              {{ Form::text('addressLine1', null, array('placeholder' => 'Address Line 1', 'required' => 'required') ) }}
          </div>
          <div class="col-sm-6 form-group">
              {{ Form::label('addressLine2', 'Address Line 2') }}
              {{ Form::text('addressLine2', null, array('placeholder' => 'Address Line 2') ) }}
          </div>
          <div class="col-sm-6 form-group">
              {{ Form::label('city', 'City') }}
              {{ Form::text('city', null, array('placeholder' => 'City', 'required' => 'required') ) }}
          </div>
          <div class="col-sm-6 form-group">
              {{ Form::label('state', 'State') }}
              {{ Form::text('state', null, array('placeholder' => 'State', 'required' => 'required') ) }}
          </div>
          <div class="col-sm-6 form-group">
              {{ Form::label('postalCode', 'Postal Code') }}
              {{ Form::text('postalCode', null, array('placeholder' => 'Postal Code', 'required' => 'required') ) }}
          </div>
          <div class="col-sm-12 form-group">
              {{ Form::submit('Update Customer', array('class' => 'btn btn-success')) }}
          </div>
      </div>
    {!! Form::close() !!}

    @if ($customer->user)
        {!! Form::model($customer, ['route' => ['customers.changePassword', $customer->customerNumber], 'method' => 'put']) !!}
            <div class="grid">
              <div class="col-sm-6 form-group">
                  {{ Form::label('currentPassword', 'Current Password') }}
                  {{ Form::text('currentPassword', null, array('required' => 'required') ) }}
              </div>
              <div class="col-sm-6 form-group">
                  {{ Form::label('password', 'New Password') }}
                  {{ Form::text('password', null, array('required' => 'required') ) }}
              </div>
              <div class="col-sm-6 form-group"></div>
              <div class="col-sm-6 form-group">
                  {{ Form::label('password_confirmation', 'New Password Confirm') }}
                  {{ Form::text('password_confirmation', null, array('required' => 'required') ) }}
              </div>
              <div class="col-sm-12 form-group">
                  {{ Form::submit('Update Password') }}
              </div>
          </div>
        {!! Form::close() !!}
    @else
        <div class="grid">
            <div class="col-sm-12 form-group">
                There is no user login information associated with this account.
            </div>
        </div>
    @endif

    <h2>Recent Order History</h2>
      <div class="grid">
        <div class="col-sm-12">
            @foreach ($customer->orders->sortByDesc('orderDate') as $o)
            <div>
              <h3>
                {{$o->orderDate}} -
                #{{$o->orderNumber}} -
                ${{$o->getTotal()}} -
                {{$o->status}}
              </h3>
            </div>
            <table class="table table-striped table-hover">
              @foreach($o->orderdetails as $orderd)
                <tr>
                  <td>{{$orderd->product->productName}}</td>
                  <td>{{$orderd->quantityOrdered}}</td>
                  <td>${{$orderd->priceEach}}</td>
                </tr>
              @endforeach
              </table>
              <br />
            @endforeach
        </div>
      </div>
</div>
@endsection
