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
                     <div onclick="openSettings(3)" class="backgroundColor setting">Personal</div>
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
                        <h3 class="mt-2 mb-5 font-weight-bolder">profile information</h3>
                        <h5 class="label pb-2">
                            About :
                        </h5>
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
                    <form class="settingsForm p-2 m-5" action="/settings" method="post"></form>
                </div>
                <div class="OptionPage" id='O3'>
                    <h1 class="sidebar-heading p-3 font-weight-bolder">Personal Options</h1>
                </div>
                <div class="OptionPage" id='O4'>
                    <h1 class="sidebar-heading p-3 font-weight-bolder">Privacy Options</h1>
                </div>
                <div class="OptionPage" id='O5'>
                    <h1 class="sidebar-heading p-3 font-weight-bolder">Products/services Options</h1>
                </div>
            </div>
            <div class="col col-lg-7"></div><!--Spacer-->
        </div>
    </div>
  @include('layouts.footer')
  @endsection
