@extends('layouts.app')

  @section('content')

        @if ($message)
          <div class="Melding alert-success">
              {{$message}}
          </div>
        @endguest

        @if ($has)
        <!--Begin scherm van list van bands waar je lid van bent--->
            <div class="jumbotron first full-height" style="height:auto;" id='selectBand'>
                <div class="text-center">
                    @for ($i = 0; $i < Count($Ids); $i++)
                        <div class="selectBand" onclick="setBand({{$i}})">
                            <div class="bandNaam">
                                {{$bands[$i][0][0]->bandName ?? 'No name'}}
                            </div>
                            @if ($bands[$i][0][0] != null)
                                @if (strlen($bands[$i][0][0]->bandName) > 1)
                                    <img src="/images/noUser.jpg" alt="Product" class="bandImage">
                                @else
                                    <img src="publicImages/images/Products/1603708349.jpeg" alt="Product" class="bandImage">
                                @endif
                            @endif
                        </div>
                    @endfor
                    <div class="selectBand">
                        <div class="bandNaam">
                            Create new Band
                        </div>
                        <form class="NewBand" action="/band/create" method="POST">
                            @csrf
                            <input type="text" name="bandName" value="" placeholder="Band Name" class="BandInput" minlength="2">
                            <input type="submit" name="" value="Create" class="create posCreate">
                        </form>
                    </div>
                </div>
            </div>
            <div class="jumbotron first" style="margin-bottom:-60px; display:none;" id='bandManger'>
                <div class="row">
                    <div class="col">
                        <div class="settings">
                         <h1 class="p-3 font-weight-bolder">Band Manger</h1>
                         <div class="list-group list-group-flush pl-3" style="height:100%;">
                             <div onclick="openSettings(1)" class="backgroundColor setting">Band Profile</div>
                             <div onclick="openSettings(2)" class="backgroundColor setting">Style Options</div>
                             <div onclick="openSettings(3)" class="backgroundColor setting">Band Member</div>
                             @for ($i = 0; $i < Count($Ids); $i++)
                                 <div class="holder" id="N{{$i}}" style="display:none;">
                                     @if($perms[$i][$myPerm[$i]] > 1)
                                         <div onclick="openSettings(4)" class="backgroundColor setting">Products/services</div>
                                         <div onclick="openSettings(7)" class="backgroundColor setting">Video's</div>
                                     @endguest
                                     <div onclick="goToSelect()" class="backgroundColor setting">Select Different Band</div>
                                     <a href="{{ url('/bandPage',$bands[$i][0][0]->id) }}" class="backgroundColor setting" id='pageLink'>ViewPage</a>
                                 </div>
                             @endfor
                         </div>
                       </div>
                    </div>
                    <div class="col col-lg-7">
                        <div class="OptionPage" id='O1' style="display:block;">
                            <h1 class="p-3 font-weight-bolder">Band Profile Options</h1>
                            @for ($b=0; $b < Count($Ids); $b++)
                                <div class="holder" id="S{{$b}}" style="display:none">
                                    <form class="settingsForm p-2 m-5" action="/band/setting" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="slot" value="{{$b}}">
                                        <h3 class="pt-3 font-weight-bolder mb-4">Profile Picture </h3>
                                        <div class="row">
                                            <div class="col col-lg-2">
                                                <input type="file" name="profileImage" class="mb-5 imgInput" value="" accept="image/*">
                                            </div>
                                            <div class="col ml-5 ">
                                                <div class="currentImg rounded">
                                                  @if(!Empty($profile[$b][0][0]->image))
                                                      <img src="publicImages/images/BandProfile/{{$profile[$b][0][0]->image}}" alt="evenements" class="imgFull rounded">
                                                  @else
                                                      <img src="/images/noUser.jpg" alt="evenements" class="imgFull rounded">
                                                  @endguest
                                                </div>
                                            </div>
                                        </div>

                                        <h3 class="pt-3 font-weight-bolder mb-4">About </h3>
                                        <textarea name="about" rows="8" cols="80">{{$profile[$b][0][0]->about ?? ' '}}</textarea>

                                        <h3 class="pt-3 mt-5 font-weight-bolder mb-5">Other social media Links</h3>

                                        <div class="Logolabel pb-2">
                                            <div class="fa fa-instagram settingIcon"></div>
                                        </div>
                                        <input type="text" name="Instagram" value="{{$social[$b][0] ?? ''}}" placeholder="Instagram" class="settingInput"><br>

                                        <div class="Logolabel pb-2">
                                            <div class="fa fa-twitter settingIcon"></div>
                                        </div>
                                        <input type="text" name="Twitter" value="{{$social[$b][1] ?? ''}}" placeholder="Twitter" class="settingInput"><br>

                                        <div class="Logolabel pb-2">
                                            <div class="fa fa-facebook settingIcon"></div>
                                        </div>
                                        <input type="text" name="Facebook" value="{{$social[$b][2] ?? ''}}" placeholder="Facebook" class="settingInput"><br>

                                        <div class="Logolabel pb-2">
                                            <div class="fa fa-linkedin settingIcon"></div>
                                        </div>
                                        <input type="text" name="Linkedin" value="{{$social[$b][3] ?? ''}}" placeholder="Linkedin" class="settingInput"><br>

                                        <div class="Logolabel pb-2">
                                            <div class="fa fa-youtube-play settingIcon"></div>
                                        </div>
                                        <input type="text" name="Youtube" value="{{$social[$b][4] ?? ''}}" placeholder="Youtube" class="settingInput"><br>

                                        <div class="Logolabel pb-2">
                                            <div class="fa fa-music settingIcon"></div>
                                        </div>
                                        <input type="text" name="Custom" value="" placeholder="Custom" class="settingInput"><br>
                                        <input type="submit" name="saveOptions" value="Save" class="gradient saveButton">
                                    </form>
                                </div>
                            @endfor
                        </div>
                        <div class="OptionPage" id='O2'>
                            <h1 class="p-3 font-weight-bolder">Style Options</h1>
                            <form class="settingsForm p-2 m-5" action="/band/setGradient" method="POST">
                                @csrf
                                <h3 class="pt-3 font-weight-bolder mb-3">Profile gradient colors :</h3>
                                <input type="hidden" name="slot" value="" id='bandId'>
                                @for ($b=0; $b < Count($Ids); $b++)
                                    <div class="holder" id="G{{$b}}" style="display:none">
                                        <div class="colorPick" onclick="activateInput(1)" style="background:{{$gradients[$b][0] ?? '#780206'}}" id="{{$b}}D1">
                                            <input type="color" id="{{$b}}G1" name="gradient1" class="ColorPicker" value="{{$gradient[$b][0] ?? '#780206'}}" onchange="setGradient(true)">
                                        </div>
                                        <div class="colorPick" onclick="activateInput(2)" style="background:{{$gradients[$b][1] ?? '#061161'}}" id="{{$b}}D2">
                                            <input type="color" id="{{$b}}G2" name="gradient2" class="ColorPicker" value="{{$gradient[$b][1] ?? '#061161'}}" onchange="setGradient(true)">
                                        </div>
                                        <div class="gradientBar gradient"id="gradientBar" style="background:linear-gradient(118deg, {{$gradients[$b][0] ?? ''}} 0%, {{$gradients[$b][1] ?? ''}} 100%); background-size: 300%; background-position: left;"></div>
                                    </div>
                                @endfor
                                <h3 class="pt-3 mt-5 font-weight-bolder mb-3">Profile font</h3>
                                <select name='font' class="fontOptions">
                                  <option value='0' class="fontOptions">Nunito</option>
                                  <option value='1' class="fontOptions">Stencil</option>
                                  <option value='2' class="fontOptions">Lato</option>
                                  <option value='3' class="fontOptions">Modak</option>
                                  <option value='4' class="fontOptions">Lobster</option>
                                  <option value='5' class="fontOptions">Montserrat</option>
                                </select>
                                <input type="submit" name="saveOptions" value="Save" class="gradient saveButton">
                            </form>
                        </div>
                        <div class="OptionPage" id='O3'>
                            <h1 class="p-3 font-weight-bolder">Band Member</h1>
                            @for ($i = 0; $i < Count($Ids); $i++)
                                <div class="holder" id="H{{$i}}" style="display:none">
                                    @for ($b = 0; $b < Count($members[$i]); $b++)
                                        <div class="BandMember">
                                            <div class="memberName gradient">
                                                {{$members[$i][$b]}}
                                            </div>
                                            <div class="formHolder">
                                                <form class="permForm" action="/band/promote" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="slot" value="{{$i}}">
                                                    <input type="hidden" name="member" value="{{$b}}">
                                                    @if($b != $myPerm[$i] && $perms[$i][$myPerm[$i]] > 1)
                                                        <select name='perms' class="fontOptions setPerm" onchange="this.form.submit()">
                                                            @if($perms[$i][$b] == 3)
                                                                <option value='3' class="fontOptions" selected>Owner</option>
                                                            @else
                                                                <option value='3' class="fontOptions">Owner</option>
                                                            @endguest
                                                            @if($perms[$i][$b] == 2)
                                                                <option value='2' class="fontOptions" selected>Admin</option>
                                                            @else
                                                                <option value='2' class="fontOptions">Admin</option>
                                                            @endguest
                                                            @if($perms[$i][$b] == 1)
                                                                <option value='1' class="fontOptions" selected>Can invite</option>
                                                            @else
                                                                <option value='1' class="fontOptions">Can invite</option>
                                                            @endguest
                                                            @if($perms[$i][$b] == 0)
                                                                <option value='0' class="fontOptions" selected>Member</option>
                                                            @else
                                                                <option value='0' class="fontOptions">Member</option>
                                                            @endguest
                                                        </select>
                                                    @else
                                                      <h2 class="pt-3 pl-5">
                                                          @if($perms[$i][$b] == 3)
                                                              Owner
                                                          @elseif($perms[$i][$b] == 2)
                                                              Admin
                                                          @elseif($perms[$i][$b] == 1)
                                                              Can invite
                                                          @elseif($perms[$i][$b] == 0)
                                                              Member
                                                          @endguest
                                                      </h2>
                                                    @endguest
                                                </form>
                                                @if($perms[$i][$myPerm[$i]] > 1 && $b != $myPerm[$i])
                                                    <form class="declineFor" action="/band/kick" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="slot" value="{{$i}}">
                                                        <input type="hidden" name="member" value="{{$b}}">
                                                        <button class="kickm kick" type="submit">
                                                          Delete Member
                                                        </button>
                                                    </form>
                                                @endguest
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            @endfor
                            <form class="" action="/search" method="POST">
                                @csrf
                                <div class="BandMember">
                                    <input type="text" name="Search" value="" placeholder="Username" class="BandInput inviteInput" minlength="2">
                                    <input type="submit" name="" value="Search" class="setPerm kick invite">
                                </div>
                            </form>

                            @for ($i = 0; $i < Count($Ids); $i++)
                                <div class="holder" id="h{{$i}}" style="display:none">
                                    @if($perms[$i][$myPerm[$i]] == 3 && Count($perms[$i]) > 1)
                                        <h6>You have to promote some to Owner to leave the band</h6>
                                    @elseif($perms[$i][$myPerm[$i]] == 3)
                                        <h6>When you leave the band will be deleted</h6>
                                    @endguest
                                    <form class="" action="/band/leave" method="POST">
                                        @csrf
                                        <input type="hidden" name="slot" value="{{$i}}">
                                        <input type="submit" name="leave" value="Leave band" class="Leave">
                                    </form>
                                </div>
                            @endfor
                        </div>
                        <div class="OptionPage" id='O4'>
                          <h1 class="sidebar-heading p-3 font-weight-bolder">Products/services Options</h1>
                          <div class="productCard gradient">
                              <div class="addProduct" onclick="addProduct()">
                                  <i class="fa fa-plus" aria-hidden="true"></i>
                              </div>
                          </div>
                          @for ($b = 0; $b < Count($Ids); $b++)
                              <div id="P{{$b}}" style="display:none">
                                  @for ($i = 0; $i < Count($products[$b]); $i++)
                                      @if(strlen($products[$b][$i]->imgName) > 2)
                                          <div class="productCard productGradient">
                                              <div class="productImage rounded">
                                                  <img src="publicImages/images/Products/{{$products[$i]->imgName}}" alt="Product" class="imgFull">
                                                  <div class="productName text-uppercase" onclick="">
                                                      {{$products[$b][$i]->productName ?? ''}}
                                                  </div>
                                              </div>
                                          </div>
                                      @else
                                          <div class="productCard productGradient">
                                              <div class="productName text-uppercase" onclick="">
                                                  {{$products[$b][$i]->productName ?? ''}}
                                              </div>
                                          </div>
                                      @endguest
                                  @endfor
                              </div>
                          @endfor
                          <div class="productInputList" id='list'>
                              <div id='holder'class="holder">
                                  <div class="close fa fa-times" onclick="closeAdd()"></div>
                                  <form class="inputs" action="/bands/product" method="POST" enctype="multipart/form-data">
                                      @csrf
                                      <div class="Label2 pb-2" style="width:25%">
                                          <h3>Product Name</h3>
                                      </div>
                                      <input type="text" name="productName" value="" placeholder="Product Name" class="productInput mb-5" maxlength="40" required><br>
                                      <div class="Label2 pb-2" style="width:25%" id='setValue' >
                                          <h3>Hour Price</h3>
                                      </div>
                                      <div class="">
                                          <div class="selectSetting gradient" id='1' onclick="setSelect(1)">

                                          </div>
                                          <div class="selectSetting setSlot" id='2' onclick="setSelect(2)">

                                          </div>
                                          <div class="selectSetting setSlot" id='3' onclick="setSelect(3)">

                                          </div>
                                      </div><br>
                                      <input type="hidden" name="selected" value="1" id='F'>
                                      <input type="hidden" name="BandId" value="" id='setBand'>
                                      <div id='hour'>
                                          <div class="Label2 pb-2" style="width:25%" id='hour1'>
                                              <h3>Hour Price</h3>
                                          </div>
                                          <input type="number" name="basePrice" value="" placeholder="Base Price" class="productInput"><br>
                                      </div>
                                      <div class="Label2 pb-2" style="width:25%">
                                          <h3>Base Price</h3>
                                      </div>
                                      <input type="number" name="hourPrice" value="" placeholder="Base Price" class="productInput mb-5" required><br>
                                      <div class="" style="width:45%">
                                          <h3>Product Information</h3>
                                      </div>
                                      <textarea class="productAbout" name="productAbout" rows="8" cols="80" required></textarea><br>

                                      <div class="Spacer"></div>

                                      <div class="Label2 pb-2">
                                          <div class="fa fa-music input Icon"></div>
                                      </div>
                                      <input type="text" name="Custom" value="" placeholder="Custom" class="productInput"><br>

                                      <div class="Label2 pb-2">
                                          <div class="fa fa-youtube-play input Icon"></div>
                                      </div>
                                      <input type="text" name="youtubeProduct" value="" placeholder="youtube link" class="productInput"><br>

                                      <div class="Label2 pb-2">
                                          <div class="fa fa-picture-o input Icon"></div>
                                      </div>
                                      <input type="file" name="productImage" value="" placeholder="Custom" class="productInput" accept="image/*"><br>

                                      <div class="row">
                                        <div class="col col-lg-7">

                                        </div>
                                          <div class="col">
                                              <button type="submit" name="button" class="uploadProduct">
                                                  <h3>Upload</h3>
                                              </button>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                        </div>
                        <div class="OptionPage pb-5" id='O7'>
                            <h1 class="p-3 font-weight-bolder">Videos</h1>
                            @for ($i=0; $i < Count($Ids); $i++)
                                <div class="holder mb-5" id="V{{$i}}" style="display:none">
                                    @for ($b=0; $b < 3; $b++)
                                        <div class="Video mb-5">
                                          <form class="" action="/band/vids" method="POST">
                                            @csrf
                                            <input type="hidden" name="slot" value="{{$i}}">
                                            <input type="hidden" name="aSlot" value="{{$b}}">
                                            <input type="text" name="vidLink" value="{{$vids[$i][$b] ?? ''}}" class="addVideo" placeholder="Video Link">
                                            <input type="submit" class="submit kick" value="Upload Video">
                                          </form>
                                        </div>
                                    @endfor
                                </div>
                            @endfor
                        </div>
                    </div>
                    <div class="col"></div>
                </div>
            </div>
        @else
        <div class="gradient">
            <div class="jumbotron first">
                <div class="container text-center mt-4">
                    <h1>Create a band ?</h1>
                    <form class="mt-4" action="/band/create" method="POST">
                        @csrf
                        <input type="text" name="bandName" value="" placeholder="Band Name" class="BandInput" minlength="2">
                        <input type="submit" name="" value="Create" class="create">
                    </form>
                </div>
                <div class="bar moreMT" style="height:50px; margin-bottom:-130px;"></div>
            </div>
            <div class="jumbotron" style="background:#191919">
                latest bands created
            </div>
          </div>
        @endif
    @include('layouts.footer')

  @endsection
