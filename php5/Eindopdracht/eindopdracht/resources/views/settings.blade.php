@extends('layouts.app')

  @section('content')
    <div class="jumbotron first">
        <div class="backgroundColor settings full-height">
            <h1 class="sidebar-heading p-3 font-weight-bolder">Settings</h1>
            <div class="list-group list-group-flush pl-3">
                <a href="#" class="backgroundColor setting">Profile</a>
                <a href="#" class="backgroundColor setting">Personal</a>
                <a href="#" class="backgroundColor setting">Safety</a>
                <a href="#" class="backgroundColor setting">Privacy</a>
                <a href="#" class="backgroundColor setting">Products/services</a>
            </div>
        </div>
    </div>
    @include('layouts.footer')
  @endsection
