@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Contact Us</h1>
    <br><br>
    <h3>Phone: 614-123-4567</h3>
    <h3>Email: lugnutzcp@gmail.com</h3>
    <br><br>
    {!! Form::open(['url' => '/contact', 'method' => 'post']) !!}
      {{ Form::label('name', 'Your Name') }}
      {{ Form::text('name', '', ['required' => 'required']) }}
      <br><br>
      {{ Form::label('email', 'Email') }}
      {{ Form::email('email', '', ['required' => 'required']) }}
      <br><br>
      {{ Form::label('message', 'Message') }}
      {{ Form::textarea('message', '', ['required' => 'required']) }}
      <br><br>
      {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
    {!! Form::close() !!}
  </div>
@endsection
