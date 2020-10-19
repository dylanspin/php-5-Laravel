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
            $settings -> where('id', $user->id)->update(['about' => $req['about'],'social' => $compresSocial]);

            return back();

        }else{
            return back();
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    private function getSocial()
    {
        $information = \App\profile::findOrFail(auth()->user()->id);
        if(strlen($information->social) < 1){
            $socialLinks = ["","","","","",""];
        }else{
            $socialLinks = unserialize($information->social);
        }

        return $socialLinks;
    }

    public function index()//task bar load
    {
        $information = \App\profile::findOrFail(auth()->user()->id);
        $about = $information->about;
        return view('settings')->with('social',$this->getSocial())->with('about',$about);
    }
}
