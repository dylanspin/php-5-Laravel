@extends('layouts.app')

  @section('content')
    <div class="jumbotron first">
        <div class="settings full-height" style="height:auto;">
            <h1 class="sidebar-heading p-3 font-weight-bolder">Settings</h1>
            <div class="list-group list-group-flush pl-3" style="height:100%;">
                <div onclick="openSettings(1)" class="backgroundColor setting">Profile</div>
                <div onclick="openSettings(2)" class="backgroundColor setting">Safety</div>
                <div onclick="openSettings(3)" class="backgroundColor setting">Personal</div>
                <div onclick="openSettings(4)" class="backgroundColor setting">Privacy</div>
                <div onclick="openSettings(5)" class="backgroundColor setting">Products/services</div>
            </div>

            <div class="SideOptions">
                <div class="OptionPage" id='O1' style="display:block;">
                    <h1 class="p-3 font-weight-bolder">Profile Options</h1>

                    <form class="settingsForm p-2 m-5" action="/settings" method="post">

                        <h3 class="mt-2 mb-5 font-weight-bolder">profile information</h3>
                        <div class="label pb-2">About :</div>
                        <textarea name="about" rows="8" cols="80"></textarea>
                        <input type="text" name="test" value="" placeholder="" class="settingInput">


                        <input type="submit" name="save" value="Save" placeholder="" class="saveButton">

                        <h3 class="pt-3 mt-5 font-weight-bolder">Other social media Links</h3>

                        <div class="label pb-2">
                            <div class="fa fa-instagram"></div>
                        </div>
                        <input type="text" name="Instagram" value="" placeholder="Instagram" class="settingInput">
                        <div class="label pb-2">
                            <div class="fa fa-instagram"></div>
                        </div>
                        <input type="text" name="Twitter" value="" placeholder="Twitter" class="settingInput">
                        <div class="label pb-2">
                            <div class="fa fa-instagram"></div>
                        </div>
                        <input type="text" name="Facebook" value="" placeholder="Facebook" class="settingInput">
                        <div class="label pb-2">
                            <div class="fa fa-instagram"></div>
                        </div>
                        <input type="text" name="Linkedin" value="" placeholder="Linkedin" class="settingInput">
                        <div class="label pb-2">
                            <div class="fa fa-instagram"></div>
                        </div>
                        <input type="text" name="Youtube" value="" placeholder="Youtube" class="settingInput">
                        <div class="label pb-2">
                            <div class="fa fa-instagram"></div>
                        </div>
                        <input type="text" name="Custom" value="" placeholder="Custom" class="settingInput">
                    </form>
                </div>
                <div class="OptionPage" id='O2'>
                    <h1 class="sidebar-heading p-3 font-weight-bolder">Safety Options</h1>
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
        </div>
    </div>

  @endsection
