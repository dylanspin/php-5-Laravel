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

    public function formSubmitStyle(Request $req)
    {
        if($req)
        {
            $user = auth()->user();

            $gradientArray = [$req['gradient1'], $req['gradient2']];
            $compresGradient = serialize($gradientArray);

            $hoverArray = [$req['hover1'], $req['hover2']];
            $compresHover = serialize($hoverArray);
            if($req['font'])
            {
                $font = $req['font'];
            }else{
                $font = 0;
            }

            $settings = new \App\profile;
            $settings -> where('id', $user->id)->update(['gradient' => $compresGradient, 'hover' => $compresHover, 'font' => $font]);

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

    private function getHover()
    {
        $information = \App\profile::findOrFail(auth()->user()->id);
        if(strlen($information->hover) < 1){
            $hover = ["#340B3C","#230b3c"];
        }else{
            $hover = unserialize($information->hover);
        }
        return $hover;
    }

    public function index()//task bar load
    {
        $information = \App\profile::findOrFail(auth()->user()->id);
        $about = $information->about;
        return view('settings')->with('social',$this->getSocial())->with('about',$about)->with('gradient',$this->getGradient())
        ->with('hover',$this->getHover());
    }
}
