<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Music Inc</title>
        <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('/images/Logo.png') }}"><!--favicon-->

    </head>
    <body>
      <!-- position-ref  -->
        <div class="flex-center full-height" style='background-image: url("/images/Stock3.jpg"); background-size: cover;'>
            @if (Route::has('login'))
                <div class="top-right links" style="">
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
                        <h1 class="cover-heading font-weight-bolder p-3 shadowEffect">Welcome to Music Inc</h1>
                        <p class="lead shadowEffect">
                            This is the place to meet and hire bands/musicians
                        </p>
                    </main>
                      <form class="links" action="/welcome/search" method="POST">
                          @csrf
                          <input class="mainSearch" type="text" name="Search" placeholder="Search" aria-label="Search">
                    </form>
                </div>
            </div>
        </div>

            <!-- <img src="/images/Stock1.jpg" alt="" class="jumbotron img-fluid mx-auto" style="position:absolute;"> -->
        <div class="jumbotron" style="background-color: #171717;">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h2 class="font-weight-bold">Easy To Use</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In aliquet sapien et libero tempor, eu lacinia velit volutpat. Ut fermentum vulputate aliquam. In vitae massa lobortis, semper lectus a, ultricies ante.</p>
                        <p><a class="Rgbbutton" href="#" role="button">View details &raquo;</a></p>
                    </div>
                    <div class="col-md-4">
                        <h2 class="font-weight-bold">World Wide</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In aliquet sapien et libero tempor, eu lacinia velit volutpat. Ut fermentum vulputate aliquam. In vitae massa lobortis, semper lectus a, ultricies ante.</p>
                        <p><a class="Rgbbutton" href="#" role="button">View details &raquo;</a></p>
                    </div>
                    <div class="col-md-4">
                        <h2 class="font-weight-bold">Customer Service</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In aliquet sapien et libero tempor, eu lacinia velit volutpat. Ut fermentum vulputate aliquam. In vitae massa lobortis, semper lectus a, ultricies ante.</p>
                        <p><a class="Rgbbutton" href="#" role="button">View details &raquo;</a></p>
                    </div>
                  </div>
            </div>
        </div>

        <div class="flex-center pb-5 mb-5" style="background-color: #191919;">
            <div class="flex-Right pl-5">
                <h1 class="font-weight-bold">Latest evenements</h1>
                <div class="row pt-5 pl">
                    <div class="column md-3 p-3">
                        <div class="imgVak">
                            <img src="/images/noUser.jpg" alt="evenements" class="imgFull">
                        </div>
                    </div>
                    <div class="column md-3 p-3">
                        <div class="imgVak">
                            <img src="/images/e2.jpg" alt="evenements" class="imgFull">
                        </div>
                    </div>
                    <div class="column md-3 p-3">
                        <div class="imgVak">
                            <img src="/images/e3.jpg" alt="evenements" class="imgFull">
                        </div>
                    </div>
                    <div class="column md-3 p-3">
                        <div class="imgVak">
                            <img src="/images/e4.jpg" alt="evenements" class="imgFull">
                        </div>
                    </div>
                </div>
                <div class="row pt-2 pl">
                    <div class="column md-6 p-3">
                        <div class="imgVak2">
                            <img src="/images/e5.jpg" alt="evenements" class="imgFull">
                        </div>
                    </div>
                    <div class="column md-6 p-3">
                        <div class="imgVak2">
                            <img src="/images/e6.jpg" alt="evenements" class="imgFull">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')


    </body>
</html>
