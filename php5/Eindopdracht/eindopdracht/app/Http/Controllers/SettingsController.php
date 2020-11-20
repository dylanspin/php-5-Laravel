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


    private function getGradient()
    {
        $information = \App\profile::findOrFail(auth()->user()->id);
        if(strlen($information->gradient) < 1){
            $gradient = ["#780206","#061161"];
        }else{
            $gradient = unserialize($information->gradient);
        }

        return $gradient;
    }

    private function getVideos($information)
    {
        if(!Empty($information->vids))
        {
            $vids = unserialize($information->vids);
        }else{
            $vids = null;
        }

        return $vids;
    }

    public function index()//task bar load
    {
        $id = auth()->user()->id;
        $products = \App\bandproduct::where('idPoster',$id)->get();
        $information = \App\profile::findOrFail($id);
        $about = $information->about;
        return view('settings')->with('social',$this->getSocial())->with('about',$about)->with('gradient',$this->getGradient())
        ->with('info',$information)->with('products',$products)->with('vids',$this->getVideos($information));
    }
}
