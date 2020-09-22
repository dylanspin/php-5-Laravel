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
                          <div class="social">
                            <a class="fa fa-instagram icon" href="https://github.com/dylanspin"></a>
                          </div>
                          <div class="social">
                            <a class="fa fa-twitter icon" href="https://github.com/dylanspin"></a>
                          </div>
                          <div class="social">
                            <a class="fa fa-facebook icon" href="https://github.com/dylanspin"></a>
                          </div>
                          <div class="social">
                            <a class="fa fa-linkedin icon" href="https://github.com/dylanspin"></a>
                          </div>
                          <div class="social">
                            <a class="fa fa-youtube-play icon" href="https://github.com/dylanspin"></a>
                          </div>
                          <div class="social">
                            <a class="fa fa-music icon" href="https://github.com/dylanspin"></a>
                          </div>
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
                                  Jobs Done : 1005
                              </h4>
                          </div>
                          <div class="color md-4 pr-5">
                              <h4>
                                  Reliability : 89%
                              </h4>
                          </div>
                      </div>
                      <h5 class="ProfileAbout text-left">
                          Ut convallis ipsum odio, vel fermentum neque pellentesque in. Duis lacinia, diam sit amet dictum facilisis,
                          neque nisl iaculis mi, eget auctor lacus velit eget elit. Phasellus id vestibulum quam. In nec congue mauris,
                          sed tristique ipsum. Aliquam vehicula accumsan placerat. Mauris vel sagittis dolor
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

          <div class="container pt-5 mt-5">
              <div class="row">
                  <div class="col">
                    <h2 class="font-weight-bold">Reviews</h2>
                    <h5 class="pt-2 grayText">Random review about this somthing more and more and some more Random Text About this Review</h5>
                    <div class="rating pt-3"><!--Moet nog met php gedaan worden moet een score uit reken van 5 sterren-->
                        <i class="fa fa-star iconStar small" aria-hidden="true"></i>
                        <i class="fa fa-star iconStar small" aria-hidden="true"></i>
                        <i class="fa fa-star iconStar small" aria-hidden="true"></i>
                        <i class="fa fa-star iconStar small" aria-hidden="true"></i>
                    </div>
                  </div>
                  <div class="col pr-5 mr-5">
                      <div class="well well-sm text-center">
                          <h1 class="font-weight-bold">4.0</h1>
                          <div class="rating"><!--Moet nog met php gedaan worden moet een score uit reken van 5 sterren-->
                              <i class="fa fa-star iconStar" aria-hidden="true"></i>
                              <i class="fa fa-star iconStar" aria-hidden="true"></i>
                              <i class="fa fa-star iconStar" aria-hidden="true"></i>
                              <i class="fa fa-star iconStar" aria-hidden="true"></i>
                          </div>
                          <div>
                              <span class="glyphicon glyphicon-user"></span>1,050,008 total
                          </div>
                      </div>
                  </div>
              </div>
              <button type="button" name="button" class="ReviewButton" id='review'>Write A Review</button>
          </div>
      </div>
  </div>

  <footer class="page-footer font-small blue pt-4 mt-5">
      <div class="container-fluid text-center text-md-left" style="background-color:#171717">
          <div class="row pt-5 pb-5">
              <div class="col-md-6 mt-md-0 mt-3 pl-5">
                  <h3 class="font-weight-bold">Music Inc</h3>
                  <h5 class="grayText">We at Music Inc strafe to make your experience easier/more fun.</h5>
              </div>
              <hr class="clearfix w-100 d-md-none pb-3">
              <div class="col-md-3 mb-md-0 mb-3 ">
                  <h5 class="text-uppercase font-weight-bold">Contact</h5>
                  <ul class="list-unstyled">
                      <li>
                          <a href="#!" class="grayText">Email</a>
                      </li>
                      <li>
                          <a href="#!" class="grayText">Call</a>
                      </li>
                      <li>
                          <a href="#!" class="grayText">Discord</a>
                      </li>
                      <li>
                          <a href="#!" class="grayText">Location</a>
                      </li>
                  </ul>
              </div>
              <div class="col-md-3 mb-md-0 mb-3">
                  <h5 class="text-uppercase font-weight-bold">Company</h5>
                  <ul class="list-unstyled">
                      <li>
                          <a href="#!" class="grayText">Who are we</a>
                      </li>
                      <li>
                          <a href="#!" class="grayText">Collab</a>
                      </li>
                      <li>
                          <a href="#!" class="grayText">Information</a>
                      </li>
                      <li>
                          <a href="#!" class="grayText">Follow us</a>
                      </li>
                  </ul>
              </div>
          </div>
      </div>
      <div class="footer-copyright text-center py-3" style="background-color:#0D0D0D;">© 2020 Copyright:
        <a href="">Music Inc</a>
      </div>
  </footer>
  @endsection
