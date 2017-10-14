@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Customers</h1>
    <div class="container">
        {{ $customers->links() }}
    </div>
    <div class="container">
        {!! Form::open(['route' => 'customers.index', 'method' => 'get']) !!}
            <div class="grid">
              <div class="col-sm-12 form-group">
                  {{ Form::text('search', null, array('required' => 'required') ) }}
                  {{ Form::submit('Search Customers') }}
              </div>
          </div>
        {!! Form::close() !!}
    </div>
    <div class="container product-display">
      <table class="listing">
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
