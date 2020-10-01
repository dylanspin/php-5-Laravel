@extends('layouts.app')

  @section('content')
    <div class="gradient">
        <div class="jumbotron first">
            <div class="container text-center mt-4">
                <h1>Search Result for : {{$search}}</h1>
            </div>
            <div class="bar moreMT" style="height:50px; margin-bottom:-130px;"></div>
        </div>
        <div class="jumbotron" style="background-color:#191919;">
            <!--moet met php later gedaan worden -->
            <div class="container full-height">
              @if($amount > 0)
                  @for ($i = 0; $i < $amount; $i++)
                      <a href="" class="card m-4 search" style="background-color:#171717;">
                          <h3 class="card-header grayText">
                            {{$results[$i]->name ?? 'Nothing'}}<!--naam profile-->
                          </h3>
                          <div class="card-body">
                            <div class="row">
                                <div class="col md-4">
                                    <div class="cardImage">
                                        <img src="/images/e4.jpg" alt="evenements" class="imgFull">
                                    </div>
                                </div>
                                <div class="col md-2">
                                    <div class="row mb-5 profileScore mr-5">
                                        <div class="color md-4 pr-5" style="display: inline-block;">
                                            <h4>
                                                Followers : 2Mil
                                            </h4>
                                        </div>
                                        <div class="color md-4 pr-5" style="display: inline-block;">
                                            <h4>
                                                Jobs Done : 1005
                                            </h4>
                                        </div>
                                        <div class="color md-4 pr-5" style="display: inline-block;">
                                            <h4>
                                                Reliability : 89%
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <div class="col pr-5 md-4">
                                   <h5>
                                       Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                       In sagittis ac ante non tempus. Proin rhoncus urna vel lectus tincidunt
                                       feugiat. Ut convallis mauris vitae magna auctor aliquet
                                   </h5>
                                </div>
                            </div>
                         </div>
                      </a>
                  @endfor
              @else
                  <h2>No Results ...</h2>
              @endif
            </div>
        </div>
    </div>

    @include('layouts.footer')
  @endsection
