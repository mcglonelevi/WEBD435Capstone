@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @foreach($products as $p)
              <div>{{$p->productName}}</div>
            @endforeach
        </div>
    </div>
</div>
@endsection
