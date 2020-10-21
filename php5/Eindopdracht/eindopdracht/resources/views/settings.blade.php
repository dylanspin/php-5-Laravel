@extends('layouts.app')

  @section('content')
    <div class="jumbotron first" style="margin-bottom:-60px;">
        <div class="row">
            <div class="col">
                <div class="settings">
                 <h1 class="p-3 font-weight-bolder">Settings</h1>
                 <div class="list-group list-group-flush pl-3" style="height:100%;">
                     <div onclick="openSettings(1)" class="backgroundColor setting">Profile</div>
                     <div onclick="openSettings(2)" class="backgroundColor setting">Safety</div>
                     <div onclick="openSettings(3)" class="backgroundColor setting">Style Options</div>
                     <div onclick="openSettings(4)" class="backgroundColor setting">Privacy</div>
                     <div onclick="openSettings(5)" class="backgroundColor setting">Products/services</div>
                 </div>
               </div>
            </div>
            <div class="col">
                <div class="OptionPage" id='O1' style="display:block;">
                    <h1 class="p-3 font-weight-bolder">Profile Options</h1>
                    <form class="settingsForm p-2 m-5" action="/settings/submit" method="GET">
                        @csrf

                        <h3 class="pt-3 font-weight-bolder mb-4">Profile Picture </h3>
                        <div class="row">
                            <div class="col col-lg-7">
                                <input type="file" name="profileImg" class="mb-5 imgInput" value="">
                            </div>
                            <div class="col">
                                <div class="currentImg rounded">
                                    <img src="/images/e1.jpg" alt="evenements" class="imgFull rounded">
                                </div>
                            </div>
                        </div>

                        <h3 class="pt-3 font-weight-bolder mb-4">About </h3>
                        <textarea name="about" rows="8" cols="80">{{$about ?? ' '}}</textarea>

                        <h3 class="pt-3 mt-5 font-weight-bolder mb-5">Other social media Links</h3>

                        <div class="Logolabel pb-2">
                            <div class="fa fa-instagram settingIcon"></div>
                        </div>
                        <input type="text" name="Instagram" value="{{$social[0] ?? ''}}" placeholder="Instagram" class="settingInput"><br>

                        <div class="Logolabel pb-2">
                            <div class="fa fa-twitter settingIcon"></div>
                        </div>
                        <input type="text" name="Twitter" value="{{$social[1] ?? ''}}" placeholder="Twitter" class="settingInput"><br>

                        <div class="Logolabel pb-2">
                            <div class="fa fa-facebook settingIcon"></div>
                        </div>
                        <input type="text" name="Facebook" value="{{$social[2] ?? ''}}" placeholder="Facebook" class="settingInput"><br>

                        <div class="Logolabel pb-2">
                            <div class="fa fa-linkedin settingIcon"></div>
                        </div>
                        <input type="text" name="Linkedin" value="{{$social[3] ?? ''}}" placeholder="Linkedin" class="settingInput"><br>

                        <div class="Logolabel pb-2">
                            <div class="fa fa-youtube-play settingIcon"></div>
                        </div>
                        <input type="text" name="Youtube" value="{{$social[4] ?? ''}}" placeholder="Youtube" class="settingInput"><br>

                        <div class="Logolabel pb-2">
                            <div class="fa fa-music settingIcon"></div>
                        </div>
                        <input type="text" name="Custom" value="" placeholder="Custom" class="settingInput"><br>
                        <input type="submit" name="saveOptions" value="Save" class="gradient saveButton">
                    </form>
                </div>
                <div class="OptionPage" id='O2'>
                    <h1 class="sidebar-heading p-3 font-weight-bolder">Safety Options</h1>
                    <form class="settingsForm p-2 m-5" action="/settings/submit2" method="GET">
                        @csrf
                        <h3 class="mt-2 mb-5 font-weight-bolder">Profile protection : </h3>
                        <h5 class="pb-2">
                            Change password :
                        </h5>
                        <div class="Logolabel pb-2" style="font-size:20px; color white; width:100px;">
                            Old
                        </div>
                        <input type="password" name="Instagram" value="" placeholder="..." class="settingInput"><br>
                        <div class="Logolabel pb-2" style="font-size:20px; color white; width:100px;">
                            New
                        </div>
                        <input type="password" name="Instagram" value="" placeholder="..." class="settingInput"><br>
                        <div class="Logolabel pb-2" style="font-size:20px; color white; width:100px;">
                            Repeat
                        </div>
                        <input type="password" name="Instagram" value="" placeholder="..." class="settingInput"><br>
                        <input type="submit" name="saveOptions" value="Save" class="gradient saveButton">
                    </form>
                </div>
                <div class="OptionPage" id='O3'>
                    <h1 class="sidebar-heading p-3 font-weight-bolder">Style Options</h1>
                    <form class="settingsForm p-2 m-5" action="/settings/submit3" method="GET">
                      @csrf
                      <h3 class="pt-3 font-weight-bolder mb-3">Profile gradient colors :</h3>
                      <input type="color" name="gradient1" class="ColorPicker" value="{{$gradient[0] ?? ''}}" id="G1" onchange="setGradient(true)">
                      <input type="color" name="gradient2" class="ColorPicker" value="{{$gradient[1] ?? ''}}" id="G2" onchange="setGradient(true)">
                      <div class="gradientBar gradient"id="gradientBar" style="background:linear-gradient(118deg, {{$gradient[0] ?? ''}} 0%, {{$gradient[1] ?? ''}} 100%); background-size: 300%; background-position: left;"></div>

                      <h3 class="pt-3 font-weight-bolder mb-3">Profile hover gradient colors :</h3>
                      <input type="color" name="hover1" class="ColorPicker" value="{{$hover[0] ?? ''}}" id="H1" onchange="setGradient(false)">
                      <input type="color" name="hover2" class="ColorPicker" value="{{$hover[1] ?? ''}}" id="H2" onchange="setGradient(false)">
                      <div class="gradientBar gradient" id="HoverBar" style="background:linear-gradient(118deg, {{$hover[0] ?? ''}} 0%, {{$hover[1] ?? ''}} 100%); background-size: 300%; background-position: left;"></div>

                      <h3 class="pt-3 mt-5 font-weight-bolder mb-3">Profile font</h3>
                      <select name='font' class="fontOptions">
                        <option value='' class="fontOptions">hier moet die er nu is</option>
                        <option value='0' class="fontOptions">Nunito</option>
                      </select>

                      <input type="submit" name="saveOptions" value="Save" class="gradient saveButton">
                    </form>
                </div>
                <div class="OptionPage" id='O4'>
                    <h1 class="sidebar-heading p-3 font-weight-bolder">Privacy Options</h1>
                </div>
                <div class="OptionPage" id='O5'>
                    <h1 class="sidebar-heading p-3 font-weight-bolder">Products/services Options</h1>
                    <div class="productCard gradient">
                        <div class="addProduct">
                            <i class="fa fa-plus" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-lg-7"></div><!--Spacer-->
        </div>
    </div>
  @include('layouts.footer')
  @endsection
