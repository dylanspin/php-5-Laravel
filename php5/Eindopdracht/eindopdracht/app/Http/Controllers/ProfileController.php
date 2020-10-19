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

    private $icons = ["fa fa-instagram","fa-twitter","fa-facebook","fa-linkedin","fa-youtube-play","fa-music"];

    private function returnScore($userPage)
    {
        $review = \App\review::where('idUserPage',$userPage)->get();
        $total = 0;
        if(Count($review) > 0)
        {
            for($i=0; $i<Count($review); $i++)
            {
                $total += $review[$i]->rating;
            }
            $score = round($total/Count($review),0);
            return $score;
        }else{
            return $total;
        }
    }

    private function returnRandomReview($userPage)
    {
        $review = \App\review::where('idUserPage',$userPage)->get();
        if(Count($review) > 0)
        {
            $random = rand(0,Count($review)-1);
            $randomReview = $review[$random]->review;
            return $randomReview;
        }else{
            return "no reviews yet";
        }
    }

    private function returnSocials($id)
    {
        $information = \App\profile::findOrFail($id);
        if(strlen($information->social) < 1){
            $socialLinks = ["","","","","",""];
        }else{
            $socialLinks = unserialize($information->social);
        }
        return $socialLinks;
    }

    private function returnTotal($userPage)
    {
        return Count(\App\review::where('idUserPage',$userPage)->get());
    }

    public function index($id)
    {
        $information = \App\profile::findOrFail($id);
        $total = $information->completed + $information->failed;
        $reli = round(100 / $total * $information->completed);
        $user = \App\User::findOrFail($id); //$user is wat er naar de profile/ word gezet voor verschillende accounts
        return view('profile')->withDetails($user)->with('information',$information)->with('user',$user)->with('total',$total)
        ->with('reli',$reli)->with('review',$this->returnRandomReview($id))->with('score',$this->returnScore($id))
        ->with('total',$this->returnTotal($id))->with('social',$this->returnSocials($id))->with('icons',$this->icons);
    }
}
