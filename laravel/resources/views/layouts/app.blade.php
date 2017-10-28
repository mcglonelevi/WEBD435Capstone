<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/reset.css') }}" rel="stylesheet">
    <link href="{{ asset('css/grid.css') }}" rel="stylesheet">
    <link href="{{ asset('css/framework.css') }}" rel="stylesheet">
    <link href="{{ asset('css/header.css') }}" rel="stylesheet">
    <link href="{{ asset('css/footer.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
  <div id="fb-root"></div>
  <script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
  <header>
    <div class="container">
      <a href="{{ url('/') }}">
        <img src="{{ asset('img/logo-nobg.png') }}" height="60" alt="Lugnutz logo">
      </a>
      <ul class="right">
        @guest
            <li><a href="{{ route('login') }}">Login</a></li>
            <li><a href="{{ route('register') }}">Register</a></li>
        @else
            <li>
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    Logout
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
            <li>
              <a href="{{ url('/customers/' . Auth::user()->customerNumber) }}" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                  {{ Auth::user()->customer->customerName }} <span class="caret"></span>
              </a>
            </li>
        @endguest
      </ul>
      <form action="/products" class="search-form">
          <input name="search" id="search" class="search" type="text" placeholder="Search by Keyword...">
          <input type="submit" value="Search">
      </form>
    </div>
  </header>
  <div class="main-nav-container">
      <div class="container">
          <nav>
              <ul class="nav">
                  @if (Request::user() && Request::user()->is_admin)
                      <li><a href="{{ url('/orders') }}" title="View Orders" >Orders</a></li>
                      <li><a href="{{ url('/products') }}" title="View Products">Products</a></li>
                      <li><a href="{{ url('/customers') }}" title="View Users">Users</a></li>
                      <li><a href="{{ url('/customers/' . Request::user()->customerNumber) }}" title="View Profile">Profile</a></li>
                  @else
                      <li><a href="{{ url('/') }}" title="Home" >HOME</a>
                      <li><a href="{{ url('/about') }}" title="About Us">ABOUT</a>
                      <li><a href="{{ url('/locations') }}" title="Store Locations">STORE</a>
                      <li><a href="{{ url('/contact') }}" title="Contact Us" >CONTACT US</a>
                  @endif
              </ul>
          </nav>
      </div>
  </div><!--// end main-nav-container -->
  <div id="body-content">
    @if (session()->has('status'))
    <div class="container">
      <div class="alert alert-danger" style="margin-bottom: 20px;">
        {{session()->get('status')}}
      </div>
    </div>
    @endif
    @yield('content')
  </div>
  <footer>
      <div class="container">
          <div class="footer-list-wrapper">
              <ul>
                  <li><a href="{{ url('/') }}" title="Homepage">Home</a></li>
                  <li><a href="{{ url('/about') }}" title="About Us">About</a></li>
                  <li><a href="{{ url('/locations') }}" title="Store Locations">Store</a></li>
                  <li><a href="{{ url('/contact') }}" title="Contact Us">Contact Us</a></li>
              </ul>
          </div>
          <div class="footer-list-wrapper">
              &copy; 2017 Lugnutz Computer Parts - All Rights Reserved | Terms & Conditions | Privacy
          </div>
      </div>
  </footer>

  <script src="{{ asset('js/framework.js') }}"></script>
</body>
</html>
