@extends('layouts.app')

  @section('content')
    <div class="gradient">
        <div class="jumbotron first">
            <div class="container text-center mt-4">
                <h1>Search Result for : {{$search}}</h1>
                @if($welcome)
                    <form class="links mb-5 pb-5" action="/search" method="POST">
                        @csrf
                        <input class="mainSearch" type="text" name="Search" placeholder="Search" aria-label="Search">
                    </form>
                @else
                  <form class="links mb-5 pb-5" action="/welcome/search" method="POST">
                      @csrf
                      <input class="mainSearch" type="text" name="Search" placeholder="Search" aria-label="Search">
                  </form>
                @endif
            </div>
            <div class="bar moreMT" style="height:50px; margin-bottom:-130px;"></div>
        </div>


        @if($welcome)
            <div class="bandList gradient" id='bandList'>
              <div class="close fa fa-times" onclick="closeInviteList()"></div>
                <div class="selectBands" >
                      <input type="hidden" id='Amount' value='{{Count($bandId)}}' style="display:none;">
                      @if($bandId != null)
                          @for ($i = 0; $i < Count($bandId); $i++)
                              <form class="bandSelect"  action="/band/Invite" method="POST">
                                  @csrf
                                  <div class="selectName">
                                      {{$bandInfo[$i][0][0]->bandName ?? 'No name'}}
                                  </div>
                                  <input type="hidden" name="inviteId" value="" id='{{$i}}Hidden'>
                                  <button type="submit" class="selectButton" name="bandId" value="{{$bandId[$i]}}">
                                      Invite
                                  </button>
                              </form>
                          @endfor
                      @endif
                </div>
            </div>
        @endif

        <div class="jumbotron" style="background-color:#191919;">
            <!--moet met php later gedaan worden -->
            <div class="container full-height">
              @if(!Empty($bandResults))
                  @for ($i = 0; $i < Count($bandResults); $i++)
                      <div class="card m-4 search" style="background-color:#171717;">
                          <a href="{{url('/bandPage',$bandResults[$i]->id)}}" class="card-header grayText visit">
                              <h3 style="display:inline-block;" class="mr-5" >{{$bandResults[$i]->bandName ?? 'Nothing'}}<!--naam profile--></h3>
                              <h3 style="display:inline-block;">band Profile</h3>
                          </a>
                          <div class="card-body">
                            <div class="row">
                                <div class="col md-4">
                                    <div class="cardImage">
                                        @if(!empty($profile[$i][0][0]->image))
                                            <img src="publicImages/images/BandProfile/{{$profile[$i][0][0]->image}}" alt="evenements" class="imgFull">
                                        @else
                                            <img src="/images/noUser.jpg" alt="evenements" class="imgFull">
                                        @endif
                                    </div>
                                </div>
                                <div class="col md-2">
                                  <h5>
                                      {{$profile[$i][0][0]->about ?? 'No information'}}
                                  </h5>
                                </div>
                            </div>
                         </div>
                      </div>
                  @endfor
              @endif

              @if(Count($results) > 0)
                  @for ($i = 0; $i < Count($results); $i++)
                      <div class="card m-4 search" style="background-color:#171717;">
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
                                  @if($welcome)
                                      <div class="col pr-5 md-4">
                                          <div class="searchInvite" onclick="inviteList({{$results[$i]->id}})">
                                              Invite To Band
                                          </div>
                                      </div>
                                  @endif
                              </div>
                          </div>
                      </div>
                  @endfor
              @endif
              @if(empty($bandResults) && empty($results))
                  <h2>No Results ...</h2>
              @endif
            </div>
        </div>
    </div>

    @include('layouts.footer')
  @endsection
