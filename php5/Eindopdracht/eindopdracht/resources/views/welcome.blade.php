<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Music Inc</title>
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    </head>
    <body>

        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
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
            <div class="container text-center">
              <div class="content col">
                  <main role="main" class="inner cover">
                      <h1 class="cover-heading font-weight-bolder p-3">Welcome to Music Inc</h1>
                      <p class="lead">
                        This is the place to meet and hire bands/musicians
                      </p>
                  </main>
                  <div class="links">
                      <a href="https://github.com/dylanspin">GitHub</a>
                  </div>
              </div>

              <!-- <div class="content col">
                <img src="/images/Stock1.jpg" alt="" class="img-fluid mx-auto">
              </div> -->
            </div>

            <!-- <div class="container">
            </div> -->
            <!-- <div class="container">
                <img src="/images/Stock1.png" alt="" style="height : 40px;">
            </div> -->
        </div>
    </body>
</html>
