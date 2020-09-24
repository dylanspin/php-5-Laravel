@extends('layouts.app')

  @section('content')

    <div class="jumbotron first">
        <div class="text-center mt-4">
            <h1>Search Result for : {{$search}}</h1>
        </div>
        <div class="bar moreMT" style="height:50px;"></div>
        <!--moet met php later gedaan worden -->
        <div class="container full-height">
          <!-- <h2>No Results ...</h2> -->
          <div class="card m-4" style="background-color:#171717;">
              <h3 class="card-header grayText">
                {{$results ?? 'Nothing'}}<!--naam profile-->
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
          </div>
        </div>
    </div>
    @include('layouts.footer')
  @endsection
