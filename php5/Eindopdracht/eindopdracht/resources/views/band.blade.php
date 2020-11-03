@extends('layouts.app')

  @section('content')
        @if ($has)

        <!--Begin scherm van list van bands waar je lid van bent--->
            <div class="jumbotron first full-height" style="height:auto;" id='selectBand'>
                <div class="text-center">
                    @for ($i = 0; $i < Count($Ids); $i++)
                        <div class="selectBand" onclick="setBand({{$i}})">
                            <div class="bandNaam">
                                {{$bands[$i][0][0]->bandName ?? 'No name'}}
                            </div>
                            @if (strlen($bands[$i][0][0]->bandName) > 1)
                                <img src="images/noUser.jpg" alt="Product" class="bandImage">
                            @else
                                <img src="publicImages/images/Products/1603708349.jpeg" alt="Product" class="bandImage">
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
            <input type="hidden" name="band" value="0" id='bandId'>
            <div class="jumbotron first" style="margin-bottom:-60px; display:none;" id='bandManger'>
                <div class="row">
                    <div class="col">
                        <div class="settings">
                         <h1 class="p-3 font-weight-bolder">Band Manger</h1>
                         <div class="list-group list-group-flush pl-3" style="height:100%;">
                             <div onclick="openSettings(1)" class="backgroundColor setting">Band Profile</div>
                             <div onclick="openSettings(2)" class="backgroundColor setting">Style Options</div>
                             <div onclick="openSettings(3)" class="backgroundColor setting">Band Member</div>
                             <div onclick="openSettings(4)" class="backgroundColor setting">Products/services</div>
                             <div onclick="openSettings(5)" class="backgroundColor setting">Songs</div>
                             <div onclick="openSettings(6)" class="backgroundColor setting">Image's</div>
                             <div onclick="goToSelect()" class="backgroundColor setting">Select Diffrent Band</div>
                             <a href="{{ url('/bandPage') }}" class="backgroundColor setting">ViewPage</a>
                         </div>
                       </div>
                    </div>
                    <div class="col col-lg-7">
                        <div class="OptionPage" id='O1' style="display:block;">
                            <h1 class="p-3 font-weight-bolder">Band Profile Options</h1>
                        </div>
                        <div class="OptionPage" id='O2'>
                            <h1 class="p-3 font-weight-bolder">Style Options</h1>
                            <h3 class="pt-3 font-weight-bolder mb-3">Profile gradient colors :</h3>
                            <div class="colorPick" onclick="activateInput(1)" style="background:{{$gradient[0] ?? ''}}" id="D1">
                                <input type="color" id="G1" name="gradient1" class="ColorPicker" value="{{$gradient[0] ?? ''}}" onchange="setGradient(true)">
                            </div>
                            <div class="colorPick" onclick="activateInput(2)" style="background:{{$gradient[1] ?? ''}}" id="D2">
                              <input type="color" id="G2" name="gradient2" class="ColorPicker" value="{{$gradient[1] ?? ''}}" onchange="setGradient(true)">
                            </div>
                            <div class="gradientBar gradient"id="gradientBar" style="background:linear-gradient(118deg, {{$gradient[0] ?? ''}} 0%, {{$gradient[1] ?? ''}} 100%); background-size: 300%; background-position: left;"></div>
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
                                            <select name='font' class="fontOptions setPerm">
                                                <option value='' class="fontOptions">Owner</option>
                                                <option value='' class="fontOptions">Admin</option>
                                                <option value='' class="fontOptions">Can invite</option>
                                                <option value='' class="fontOptions">Member</option>
                                            </select>
                                            <div class="setPerm kick">
                                              Delete Member
                                            </div>
                                        </div>
                                    @endfor
                                </div>
                            @endfor
                            <div class="BandMember">
                                <input type="text" name="Username" value="" placeholder="Username" class="BandInput inviteInput" minlength="2">
                                <input type="submit" name="" value="Invite" class="setPerm kick invite">
                            </div>

                        </div>
                        <div class="OptionPage" id='O4'>
                            <h1 class="p-3 font-weight-bolder">Products/services</h1>
                        </div>
                        <div class="OptionPage" id='O5'>
                            <h1 class="p-3 font-weight-bolder">Songs</h1>
                        </div>
                        <div class="OptionPage" id='O6'>
                            <h1 class="p-3 font-weight-bolder">Image's</h1>
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
            <div class="jumbotron" style="background:#191919">
                most popular bands
            </div>
          </div>
        @endif
    @include('layouts.footer')

  @endsection
