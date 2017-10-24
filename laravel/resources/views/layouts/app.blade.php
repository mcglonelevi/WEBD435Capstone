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
                  {{ Auth::user()->name }} <span class="caret"></span>
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
  <div id="body-content">
    @yield('content')
  </div>
  <footer>
      <div class="container">
          <div class="footer-list-wrapper">
              <ul>
                  <li><a href="#">Home</a></li>
                  <li><a href="#">About</a></li>
                  <li><a href="#">Store</a></li>
                  <li><a href="#">Contact Us</a></li>
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
