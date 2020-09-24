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
        $user = \App\User::findOrFail($user); //$user is wat er naar de profile/ word gezet voor verschillende accounts
        return view('profile',['user' => $user]);
    }
}
