@extends('layouts.app')

@section('content')
  <div class="col-sm-12">
      <img src="https://promotions.newegg.com/intel/17-4215/1920x360.jpg" alt="Banner" border="0" class="img-responsive" />
  </div>
  <div class="container featured-products-area">
      <section>
            <h3>FEATURED PRODUCTS</h3>
            @foreach($products->chunk(3) as $chunk)
            <article>
                <div class="grid">
                  @foreach($chunk as $p)
                    <div class="col-sm-4 featured-product-wrapper">
                      <a href="{{ route('products.show', [$p]) }}">
                        <div class="sexy-box">
                                @if ($p->image_url)
                                  <img src="{{ asset($p->image_url) }}" alt"Feature" class="special-feature" />
                                @else
                                  <img src="http://via.placeholder.com/300x300" alt"Feature" class="special-feature" />
                                @endif
                        </div>
                        {{ $p->productName }}
                      </a>
                    </div>
                  @endforeach
                </div>
            </article>
            @endforeach
      </section>

  </div>
@endsection
