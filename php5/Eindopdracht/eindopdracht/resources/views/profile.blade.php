<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <body>
      <div class="content">

          <!--header-->
          @if (Route::has('login'))
              <div class="top-right links">
                  <a href="{{ url('/profile') }}">Settings</a>
                  <a href="{{ url('/profile') }}">Agenda's</a>
                  <a href="{{ url('/profile') }}">Booked</a>
                  <a href="{{ url('/profile') }}">Message's</a>
                  <a href="{{ url('/profile') }}">Profile</a>
                  @auth
                      <a href="{{ url('/home') }}">Home</a>
                  @else
                      <a href="{{ route('login') }}">Login</a>

                      @if (Route::has('register'))
                          <a href="{{ route('register') }}">Register</a>
                      @endif
                  @endauth
              </div>
          @endif


          <div class="container">
            <div class="row">
              <div class="col-sm">
                One of three columns
              </div>
              <div class="col-sm">
                One of three columns
              </div>
              <div class="col-sm">
                One of three columns
              </div>
            </div>
          </div>
          <div class="introVid">

          </div>

      </div>
    </body>
</html>
