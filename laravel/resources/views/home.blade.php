@extends('layouts.app')

@section('content')
   <div class="main-nav-container"> 
        <div class="container">
            <nav>
                <ul class="nav">
                    <li><a href="#" title="Home" >HOME</a>
                    <li><a href="#" title="About">ABOUT</a>
                    <li><a href="#" title="Store">STORE</a>
                    <li><a href="#" title="Contact Us" >CONTACT US</a>
                </ul>  
            </nav>
        </div>
  </div><!--// end main-nav-container -->
  <div class="col-sm-12">
      <img src="https://promotions.newegg.com/intel/17-4215/1920x360.jpg" alt="Banner" border="0" class="img-responsive" />
  </div>
  <div class="container featured-products-area">
      <section>
            <h3>FEATURED PRODUCTS</h3>
            <article>
                <div class="grid">
                    <div class="col-sm-4">
                        <div class="sexy-box">
                            <a href="#">
                                <img src="https://images10.newegg.com/NeweggImage/ProductImageCompressAll300/A0ZX_1_201702232042574573.jpg?t=1023171" alt"Feature" class="special-feature" />
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="sexy-box">
                            <a href="#">
                                <img src="https://images10.newegg.com/ProductImageCompressAll300/24-009-909-07.jpg?t=1023171" alt"Feature" class="special-feature" />
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="sexy-box">
                            <a href="#">
                                <img src="https://images10.newegg.com/NeweggImage/ProductImageCompressAll300/A0ZX_1_201702232042574573.jpg?t=1023171" alt"Feature" class="special-feature" />
                            </a>
                        </div>
                    </div>
                </div>
            </article>
            <article>
                <div class="grid">
                    <div class="col-sm-4">
                        <div class="sexy-box">
                            <a href="">    
                                <img src="https://images10.newegg.com/NeweggImage/ProductImageCompressAll300/23-201-106-Z01.jpg?t=1023171" alt"Feature"class="special-feature" />
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="sexy-box">
                            <a href=""> 
                                 <img src="https://images10.newegg.com/NeweggImage/ProductImageCompressAll300/A0ZX_1_201702232042574573.jpg?t=1023171" alt"Feature" class="special-feature" />
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="sexy-box">
                            <a href=""> 
                                <img src="https://images10.newegg.com/ProductImageCompressAll300/14-127-943-S99.jpg?t=1023171" alt"Feature" class="special-feature" />
                            </a>
                        </div>
                    </div>
                </div>
            </article>
      </section>
     
  </div>
@endsection
