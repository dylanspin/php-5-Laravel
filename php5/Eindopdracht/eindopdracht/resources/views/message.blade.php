@extends('layouts.app')

  @section('content')
  <div class="gradient">
      <div class="jumbotron first">
        <div class="container text-center mt-4">
            <h1>Message's</h1>
        </div>
        <div class="bar moreMT" style="height:50px; margin-bottom:-130px;"></div>
      </div>
      <div class="jumbotron full-height" style="background:#191919;">
          @for ($i = 0; $i < Count($messages); $i++)
              @if($messages[$i]->type == 0)
                  <div class="message">
                      <div class="Mtext">
                        Invite to {{$names[$i] ?? ' '}}
                      </div>
                      <form class="declineForm" action="/message/accept" method="POST">
                          @csrf
                          <input type="hidden" name="idMessage" value="{{$i}}">
                          <button type="submit" name="accept" class="Accept Mbox fa fa-check"></button>
                      </form>
                      <form class="declineForm" action="/message/decline" method="POST">
                          @csrf
                          <input type="hidden" name="idMessage" value="{{$i}}">
                          <button type="submit" name="dont" class="dont Mbox fa fa-times"></button>
                      </form>
                  </div>
              @else
                  <form class="message" action="/message/remove" method="POST">
                      @csrf
                      <div class="Mtext">
                        You have a new review
                      </div>
                      <input type="hidden" name="idMessage" value="">
                      <div class="Mremove dont Mbox fa fa-times"></div>
                  </form>
            @endguest
          @endfor
      </div>
  </div>
  @include('layouts.footer')

  @endsection
