@extends('layouts.app')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Music Inc</title>
    <body>

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9 pt-5">
                <h1>{{$user->name}}</h1>
            </div>
            <div class="d-flex">
              <div class="pr-5">
                  <h2>Test</h2>
              </div>
              <div class="pr-5">
                  <h2>Test</h2>
              </div>
              <div class="pr-5">
                  <h2>Test</h2>
              </div>
            </div>
        </div>
    </div>

    <div class="container">

    </div>
    @endsection
    </body>
</html>
