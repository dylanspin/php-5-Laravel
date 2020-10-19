<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
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

    public function formSubmit(Request $req)
    {
        if($req)
        {
            $user = auth()->user();
            $socialLinksArray = [$req['Instagram'], $req['Twitter'], $req['Facebook'], $req['Linkedin'], $req['Youtube'], $req['Custom']];

            $compresSocial = serialize($socialLinksArray);

            $settings = new \App\profile;
            $settings->id = $user->id;
            $settings->about = "test information";
            $settings->social = $socialLinksArray;
            $settings->update();
            return view('settings');
        }else{
            return view('settings');
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        $information = \App\profile::findOrFail($user->id);
        if(strlen($information->social) < 1){
            $socialLinks = ["","","","","",""];
        }else{
            $socialLinks = unserialize($information->social);
        }
        return view('settings')->with('social',$socialLinks);
    }
}
