@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <ul>
            @foreach($products as $p)
              <li><a href="{{ url('/products/' . $p->productCode) }}">{{$p->productName}}</li>
            @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
