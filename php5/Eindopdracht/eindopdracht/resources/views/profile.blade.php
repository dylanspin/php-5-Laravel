@extends('layouts.app')

  <!-- <h1>{{$user->name}}</h1> -->
  @section('content')
  <!-- style="background-color:red;" -->
  <div class="gradient">
      <div class="jumbotron first">
          <div class="container">
              <div class="row">
                  <div class="col pl-5">
                      <div class="socialHolder"><!--moet nog met php gedaan later als de instellingen zijn gedaan--->
                          @for ($i = 0; $i <= 5; $i++)
                              @if (strlen($social[$i]) > 0)
                                  <div class="social">
                                      <a class="fa {{$icons[$i]}} icon" href="{{$social[$i]}}"></a>
                                  </div>
                              @endif
                          @endfor
                      </div>
                      <div class="profileImage" style="display:inline-block;">
                          <img src="/images/e1.jpg" alt="evenements" class="imgFull rounded">
                      </div>
                  </div>
                  <div class="col md-8 pr-5">
                      <h1 class="profileName shadowEffect">{{$user->name}}</h1>
                      <div class="row mb-5 profileScore">
                          <div class="color md-4 pr-5 ">
                              <h4>
                                  Followers : 2Mil
                              </h4>
                          </div>
                          <div class="color md-4 pr-5">
                              <h4>
                                  Jobs Done : {{$total}}
                              </h4>
                          </div>
                          <div class="color md-4 pr-5">
                              <h4>
                                  Reliability : {{$reli}}%
                              </h4>
                          </div>
                      </div>
                      <h5 class="ProfileAbout text-left">
                          {{$information->about}}
                      </h5>
                  </div>
              </div>
          </div>
      </div>

      <div class="jumbotron" style="background-color:#191919;">
          <div class="bar"></div>

          <div class="container">
              <h1 class="font-weight-bold">Services </h1>
              <div class="card-deck mb-5 text-center mt-5">
                  <div class="card box-shadow">
                      <div class="card-header gradient">
                          <h4 class="my-0 font-weight-normal">Free</h4>
                      </div>
                      <div class="card-body">
                          <h1 class="card-title pricing-card-title">$0</h1>
                          <ul class="list-unstyled mt-3 mb-4">
                              <li>10 users included</li>
                              <li>2 GB of storage</li>
                              <li>Email support</li>
                              <li>Help center access</li>
                          </ul>
                          <button type="button" class="btn btn-lg btn-block btn-outline-primary">Contact</button>
                      </div>
                  </div>
                  <div class="card box-shadow">
                      <div class="card-header gradient">
                          <h4 class="my-0 font-weight-normal">Free</h4>
                      </div>
                      <div class="card-body">
                          <h1 class="card-title pricing-card-title">$0</h1>
                          <ul class="list-unstyled mt-3 mb-4">
                              <li>10 users included</li>
                              <li>2 GB of storage</li>
                              <li>Email support</li>
                              <li>Help center access</li>
                          </ul>
                          <button type="button" class="btn btn-lg btn-block btn-outline-primary">Contact</button>
                      </div>
                  </div>
                  <div class="card box-shadow">
                      <div class="card-header gradient">
                          <h4 class="my-0 font-weight-normal">Free</h4>
                      </div>
                      <div class="card-body">
                          <h1 class="card-title pricing-card-title">$0</h1>
                          <ul class="list-unstyled mt-3 mb-4">
                              <li>10 users included</li>
                              <li>2 GB of storage</li>
                              <li>Email support</li>
                              <li>Help center access</li>
                          </ul>
                          <button type="button" class="btn btn-lg btn-block btn-outline-primary">Contact</button>
                      </div>
                  </div>
              </div>
          </div>

          <div class="bar moreMT"></div>

          <div class="container">
              <h1 class="font-weight-bold">Photo Gallary</h1>
              <div class="row pt-5 pl">
                  <div class="column md-3 p-3">
                      <div class="imgVak">
                          <img src="/images/e1.jpg" alt="evenements" class="imgFull">
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
                  <div class="column md-3 p-3">
                      <div class="imgVak">
                          <img src="/images/e4.jpg" alt="evenements" class="imgFull">
                      </div>
                  </div>
                  <div class="column md-3 p-3">
                      <div class="imgVak">
                          <img src="/images/e4.jpg" alt="evenements" class="imgFull">
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
  <div class="jumbotron" style="background-color:#171717; margin-bottom:-30px;">
      <div class="container pt-5 mt-5" style="height:auto; transition:0.3">
          <div class="row">
              <div class="col">
                <h2 class="font-weight-bold">Reviews</h2>
                <h5 class="pt-2 grayText">{{$review}}</h5>
                <div class="rating pt-3"><!--Moet nog met php gedaan worden moet een score uit reken van 5 sterren-->
                    @for ($i = 0; $i < 5; $i++)
                        <i class="fa fa-star iconStar small" aria-hidden="true"></i>
                    @endfor
                </div>
              </div>
              <div class="col pr-5 mr-5">
                  <div class="well well-sm text-center">
                      <h1 class="font-weight-bold">{{$score}}</h1>
                      <div class="rating"><!--Moet nog met php gedaan worden moet een score uit reken van 5 sterren-->
                          @for ($i = 0; $i < $score; $i++)
                              <i class="fa fa-star iconStar" aria-hidden="true"></i>
                          @endfor
                          @for ($i = 0; $i < 5-$score; $i++)
                              <i class="fa fa-star iconStar unselected" aria-hidden="true"></i>
                          @endfor
                      </div>
                      <div>
                          <span class="glyphicon glyphicon-user"></span>{{$total}} total
                      </div>
                  </div>
              </div>
          </div>

          <button type="button" name="button" class="ReviewButton" id='reviewButton' onclick="writeReview()">Write A Review</button>
          <div class="reviewForm" id='reviewForm'>
              <form class="pt-5" action="/review" method="POST">
                  @csrf
                  <textarea type="text" name="review" placeholder="write a review" rows="4" cols="50"></textarea>
                  <input type="hidden" name="stars" value="5" id='starHidden'>
                  <input type="hidden" name="pageId" value="{{$user->id}}" id='starHidden'>
                  <div class="stars">
                      @for ($i = 0; $i < 5; $i++)
                          <button class="fa fa-star unselected starButton" type="button" id='star{{$i}}' onclick="setStar({{$i}})"></button>
                      @endfor
                  </div>
                  <input type="submit" name="postReview" value="Post" class="btn  btn-outline-primary">
              </form>
          </div>
      </div>
  </div>


  @include('layouts.footer')
  @endsection
