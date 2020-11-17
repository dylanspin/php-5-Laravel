@extends('layouts.app')

  @section('content')
    <div class="jumbotron first full-height">
      <div class="returnProfile">
        {{$returnId}} <!--moet voor de return a gebruikt worden--->
        <a href="{{ url('/profile',$returnId)}}" class="nav-link Link2">Profile</a>
      </div>
        @for ($i = 0; $i <$amount; $i++)
            {{$i}} <br>
        @endfor
    </div>
    @include('layouts.footer')

  @endsection
