<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index($user)
    {
        $information = \App\profile::findOrFail($user);
        $total = $information->completed + $information->failed;
        $reli = round(100 / $total * $information->completed);
        $user = \App\User::findOrFail($user); //$user is wat er naar de profile/ word gezet voor verschillende accounts
        return view('profile')->withDetails($user)->with('information',$information)->with('user',$user)->with('total',$total)->with('reli',$reli);
        // return view('profile',['user' => $user]);
    }
}
