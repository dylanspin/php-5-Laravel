@extends('layouts.app')

  @section('content')
    <div class="gradient">
        @if ($has)
          <div class="jumbotron first">
          </div>
        @else
            <div class="jumbotron first">
                <div class="container text-center mt-4">
                    <h1>Create a band ?</h1>
                    <form class="mt-4" action="/band/create" method="POST">
                        @csrf
                        <input type="text" name="bandName" value="" placeholder="Band Name" class="BandInput" minlength="2">
                        <input type="submit" name="" value="Create" class="create">
                    </form>
                </div>
                <div class="bar moreMT" style="height:50px; margin-bottom:-130px;"></div>
            </div>
            <div class="jumbotron" style="background:#191919">
                latest bands created
            </div>
            <div class="jumbotron" style="background:#191919">
                most popular bands
            </div>
        @endif
    </div>
    @include('layouts.footer')

  @endsection
