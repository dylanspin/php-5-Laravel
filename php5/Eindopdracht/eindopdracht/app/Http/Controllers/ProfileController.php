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
        // $this->middleware('auth');
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

    private function getGradient($id,$isProfile)
    {
        if($isProfile)
        {
            $information = \App\profile::findOrFail($id);
        }else{
            $information = \App\bandprofile::findOrFail($id);
        }
        if(strlen($information->gradient) < 1){
            $gradient = ["#780206","#061161"];
        }else{
            $gradient = unserialize($information->gradient);
        }
        return $gradient;
    }

    private function returnSocials($id,$isProfile)
    {
        if($isProfile)
        {
            $information = \App\profile::findOrFail($id);
        }else{
            $information = \App\bandprofile::findOrFail($id);
        }

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


    private function returnProducts($id)
    {
        $products = \App\bandproduct::where('idPoster',$id)->get();
        return $products;
    }

    private function returnMembers($information)
    {
        $memberInfo = array();
        $membersArray = unserialize($information->members);

        for($i=0; $i<Count($membersArray); $i++)
        {
            $information = \App\profile::findOrFail($membersArray[$i]);
            array_push($memberInfo,$information);
        }

        return $memberInfo;
    }

    private function returnNames($information)
    {
        $memberInfo = array();
        $membersArray = unserialize($information->members);

        for($i=0; $i<Count($membersArray); $i++)
        {
            $information = \App\User::findOrFail($membersArray[$i]);
            array_push($memberInfo,$information->name);
        }

        return $memberInfo;
    }

    public function index($id)
    {
        $products = \App\bandproduct::where('idPoster',$id)->get();
        $productLength = Count($products);
        $information = \App\profile::findOrFail($id);

        $total = $information->completed + $information->failed;
        $user = \App\User::findOrFail($id);
        if(!Empty($information->vids))
        {
            $vids = unserialize($information->vids);
        }else{
            $vids = null;
        }

        return view('profile')->withDetails($user)->with('information',$information)->with('user',$user)->with('total',$total)
        ->with('review',null)->with('score',$this->returnScore($id))->with('vids',$vids)
        ->with('social',$this->returnSocials($id,true))->with('icons',$this->icons)
        ->with('gradient',$this->getGradient($id,true))->with('products',$products)->with('isband',false);
    }

    public function showBand($id)//deze moet aangepast worden dat die band dingen laat zien
    {
        $products = \App\bandproduct::where('idPoster',$id)->get();
        $information = \App\bandprofile::findOrFail($id);
        $total = Count(\App\review::where('idUserPage',$id)->get());
        $user = \App\band::findOrFail($id);
        if(!Empty($information->vids))
        {
            $vids = unserialize($information->vids);
        }else{
            $vids = null;
        }

        return view('profile')->with('information',$information)->with('social',$this->returnSocials($id,false))->with('user',$user)
        ->with('isband',true)->with('review',$this->returnRandomReview($id))->with('score',$this->returnScore($id))
        ->with('gradient',$this->getGradient($id,false))->with('members',$this->returnMembers($user))->with('names',$this->returnNames($user))
        ->with('total',$total)->with('vids',$vids);
    }
}
