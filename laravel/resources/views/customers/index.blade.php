@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Customers</h1>
    {!! Form::open(['route' => 'customers.index', 'method' => 'get']) !!}
      <div class="grid">
        <div class="col-sm-4 form-group">
          {{ Form::text('search', null, array('placeholder' => 'Search customers by name...', 'class' => 'form-control') ) }}
        </div>
        <div class="col-sm-4 form-group">
          {{ Form::submit('Search Customers', ['class' => 'btn btn-primary btn-md']) }}
        </div>
      </div>
    {!! Form::close() !!}
    <br>
    <div class="container">
        {{ $customers->links() }}
    </div>
    <div class="container product-display">
      <table class="table table-striped">
        @foreach($customers as $c)
          <tr>
              <td>
                <a href="{{ url('/customers/' . $c->customerNumber) }}">{{$c->customerName}}</a>
              </td>
          </tr>
        @endforeach
      </table>
    </div>
    <div class="container">
        {{ $customers->links() }}
    </div>
</div>
@endsection
