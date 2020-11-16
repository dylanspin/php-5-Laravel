@extends('layouts.app')

  @section('content')
  <div class="profileGradient F{{$information->font}}" style="background:linear-gradient(118deg, {{$gradient[0] ?? ''}} 0%, {{$gradient[1] ?? ''}} 100%);background-size: 300%; background-position: left;">
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
                          @if (strlen($information->image) > 0)
                              <img src="/publicImages/images/Profile/{{$information->image}}" alt="evenements" class="imgFull rounded">
                          @else
                              <img src="/images/noUser.jpg" alt="evenements" class="imgFull rounded">
                          @endguest
                      </div>
                  </div>
                  <div class="col md-8 pr-5">
                      <h1 class="profileName">{{$user->name}}</h1>
                      <div class="row mb-5 profileScore">
                          <div class="color md-4 pr-5 ">
                              <h4>
                                  Followers : 2Mil
                              </h4>
                          </div>
                          <div class="color md-4 pr-5">
                              <h4>
                                  Jobs Done : {{$total ?? '0'}}
                              </h4>
                          </div>
                          <div class="color md-4 pr-5">
                              <h4>
                                  Reliability : {{$reli ?? ''}}%
                              </h4>
                          </div>
                      </div>
                      <h5 class="ProfileAbout text-left">
                          {{$information->about ?? 'No information'}}
                      </h5>
                  </div>
              </div>
          </div>
      </div>

      <div class="jumbotron" style="background-color:#171717;">
          <div class="bar"></div>
          @if($isband)
              <div style="text-align:center">
                  <h1 class="font-weight-bold mb-5">Services </h1>
                  @if($productAmount > 0)
                      @for ($i = 0; $i < $productAmount; $i++)
                          <div class="col col-lg-3 cardss">
                              <div class="card box-shadow productC" onclick="showProduct({{$i}})">
                                  <div class="card-header profileGradient" style="background:linear-gradient(118deg, {{$gradient[0] ?? ''}} 0%, {{$gradient[1] ?? ''}} 100%); background-size: 300%; background-position: left;">
                                      <h4 class="my-0 font-weight-normal"  id='nameCard{{$i}}'>{{$products[$i]->productName ?? 'No Name'}}</h4>
                                  </div>
                                  <div class="card-body">
                                      <h1 class="card-title pricing-card-title"  id='price{{$i}}'>${{$products[$i]->basePrice ?? 'No Name'}}</h1>
                                      <ul class="list-unstyled mt-3 mb-4">
                                          @if($products[$i]->type == 1)
                                              <h5 style="color:white;" id='hourPrice{{$i}}'>Per hour : ${{$products[$i]->price}}</h5>
                                          @endguest
                                          @if($products[$i]->type == 3)
                                              <h5 style="color:white;">Price can be discused</h5>
                                          @endguest
                                          <div class="productInfo" id='aboutCard{{$i}}'>{{$products[$i]->postText}}</div>
                                      </ul>
                                  </div>
                              </div>
                          </div>
                       @endfor
                  @else
                      <h2 class="mt-5">No Services yet</h2>
                  @endguest

                  <div class="ShowCard" id='card'>
                      <div class="holder" id='holder'>
                          <div class="topGradient profileGradient mb-4" id='nameProduct' style="background:linear-gradient(118deg, {{$gradient[0] ?? ''}} 0%, {{$gradient[1] ?? ''}} 100%); background-size: 300%; background-position: left;">
                              <h1 class="text-center" id='setName'>Een test naam</h1>
                              <div class="closeCard" onclick="closeCard()">
                                  <i class="fa fa-times" aria-hidden="true"></i>
                              </div>
                          </div>
                          <h2 class="productKop">Information :</h2>
                          <div class="cardabout" id='setAbout'>
                            <!--About information set with js-->
                          </div>
                          <h4>Base Price</h4>
                          <h3 class="mb-3" id='setPrice'>$0</h3>
                          <h3 class="" id='setHour'>$100 <small class="text-muted">/ Hour</small></h3>
                          <form class="" action="" method="post">
                            <button type="submit" name="contact" class="contactButton">Order</button>
                          </form>
                      </div>
                  </div>
              </div>

              <div class="bar moreMT"></div>

              <div class="container">
                  <h1 class="font-weight-bold">Band Members</h1>

                  <div style="text-align:center">
                      <a class="selectBand memberCard" href="{{url('/profile',3)}}">
                          <div class="bandNaam">
                              Dylan Spin
                          </div>
                          <img src="/images/noUser.jpg" class="bandImage">
                      </a>
                  </div>
              </div>
              <div class="bar moreMT"></div>
          @endguest

          <div class="jumbotron" style="background-color:#171717;">
              <div class="container">
                  <h1 class="font-weight-bold">Video's</h1>
                  <h2 class="mt-5">No video's yet</h2>
                  <!--hier moet nog een function komen die checkt als er een video links is of meerdere en die dan de youtube vids laat zien--->
                  <!-- <iframe width="820" height="415" class="ProfileVideo m-4"
                      src="https://www.youtube.com/embed/WKuaujIHBT4">
                  </iframe> -->

              </div>
          </div>

          <div class="bar moreMT"></div>

          <div class="container">
              <h1 class="font-weight-bold">Photo Gallary</h1>
              <div class="row pt-5 pl">
                  <div class="column md-3 p-3">
                      <div class="imgVak">
                          <img src="/images/e5.jpg" alt="evenements" class="imgFull">
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
                          <img src="/images/e6.jpg" alt="evenements" class="imgFull">
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

  @if($isband)
      <div class="jumbotron" style="background-color:#171717; margin-bottom:-30px; margin-top:-33px; min-height:450px;">
          <div class="container mt-5" style="height:auto; transition:0.3">
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
  @endguest

  @include('layouts.footer')
  @endsection
