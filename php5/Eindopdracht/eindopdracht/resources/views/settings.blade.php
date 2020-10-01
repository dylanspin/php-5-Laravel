@extends('layouts.app')

  @section('content')
    <div class="jumbotron first">
        <div class="settings full-height">
            <h1 class="sidebar-heading p-3 font-weight-bolder">Settings</h1>
            <div class="list-group list-group-flush pl-3">
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
                        <label class="label pb-2"><h4>test</h4></label>
                        <input type="text" name="test" value="" placeholder="" class=>
                        <input type="submit" name="save" value="Save" placeholder="" class="saveButton">
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
    @include('layouts.footer')
  @endsection
