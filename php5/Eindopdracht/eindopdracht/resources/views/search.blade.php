@extends('layouts.app')

  @section('content')
    <div class="gradient">
        <div class="jumbotron first">
            <div class="container text-center mt-4">
                <h1>Search Result for : {{$search}}</h1>
            </div>
            <div class="bar moreMT" style="height:50px; margin-bottom:-130px;"></div>
        </div>
        <div class="bandList gradient" id='bandList'>
          <div class="close fa fa-times" onclick="closeInviteList()"></div>
            <div class="selectBands">
              @if($bandId != null)
                  @for ($i = 0; $i < Count($bandId); $i++)
                      <div class="bandSelect">
                          <div class="selectName">
                            {{$bandInfo[$i][0][0]->bandName ?? 'No name'}}
                          </div>
                          <div class="selectButton" onclick="SelectBand({{$bandId[$i]}})" id='S{{$bandId[$i]}}'>
                              Select
                          </div>
                      </div>
                  @endfor
              @endif
            </div>
            <form class="sendForm" action="/band/Invite" method="POST">
                @csrf
                <input type="hidden" name="inviteId" value="" id='HiddenId'>
                <input type="hidden" name="list" value="" id='bandList'>
                <input type="submit" name="sendInvite" value="sendInvite" class="sendInvite">
            </form>
        </div>
        <div class="jumbotron" style="background-color:#191919;">
            <!--moet met php later gedaan worden -->
            <div class="container full-height">
              @if($amount > 0)
                  @for ($i = 0; $i < $amount; $i++)
                      <div href="{{url('/profile',$results[$i]->id)}}" class="card m-4 search" style="background-color:#171717;">
                          <a href="{{url('/profile',$results[$i]->id)}}" class="card-header grayText visit">
                            <h3>{{$results[$i]->name ?? 'Nothing'}}<!--naam profile--></h3>
                          </a>
                          <div class="card-body">
                            <div class="row">
                                <div class="col md-4">
                                    <div class="cardImage">
                                        <img src="/images/e4.jpg" alt="evenements" class="imgFull">
                                    </div>
                                </div>
                                <div class="col md-2">
                                  <h5>
                                     {{$info[$i] ?? 'No user information'}}
                                  </h5>
                                </div>
                                <div class="col pr-5 md-4">
                                  <div class="searchInvite" onclick="inviteList({{$results[$i]->id}})">
                                      Invite To Band
                                  </div>
                                </div>
                            </div>
                         </div>
                      </div>
                  @endfor
              @else
                  <h2>No Results ...</h2>
              @endif
            </div>
        </div>
    </div>

    @include('layouts.footer')
  @endsection
