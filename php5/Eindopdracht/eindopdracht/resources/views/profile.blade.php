@extends('layouts.app')

  <!-- <h1>{{$user->name}}</h1> -->
  @section('content')
  <!-- style="background-color:red;" -->
  <div class="gradient">
      <div class="jumbotron first">
          <div class="container">
              <div class="row">
                  <div class="col pl-5">
                      <div class="profileImage" style="display:inline-block;">
                          <img src="/images/e1.jpg" alt="evenements" class="imgFull rounded">
                      </div>
                  </div>
                  <div class="col md-8 pr-5">
                      <h1 class="profileName">Dylan Spin</h1>
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
      </div>
  </div>

  <!-- <div class="row">
      <div class="col md-2 pl-5">
          <div class="profileImage float-left" style="display:inline-block;">
              <img src="/images/e1.jpg" alt="evenements" class="imgFull rounded">
          </div>
          <div class="row mb-5" style="display:inline;">
              <div class="color md-4 pr-5">
                  <h4>
                      Followers :
                  </h4>
              </div>
              <div class="color md-4 pr-5">
                  <h4>
                      Jobs Done :
                  </h4>
              </div>
              <div class="color md-4 pr-5">
                  <h4>
                      Reliability :
                  </h4>
              </div>
          </div>
          <h5 class="ProfileAbout">
              Ut convallis ipsum odio, vel fermentum neque pellentesque in. Duis lacinia, diam sit amet dictum facilisis,
              neque nisl iaculis mi, eget auctor lacus velit eget elit. Phasellus id vestibulum quam. In nec congue mauris,
              sed tristique ipsum. Aliquam vehicula accumsan placerat. Mauris vel sagittis dolor
          </h5>
        </div>
    </div> -->
  @endsection
