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

    public function index($id)
    {
        $information = \App\profile::findOrFail($id);
        $total = $information->completed + $information->failed;
        $reli = round(100 / $total * $information->completed);
        $user = \App\User::findOrFail($id); //$user is wat er naar de profile/ word gezet voor verschillende accounts
        return view('profile')->withDetails($user)->with('information',$information)->with('user',$user)->with('total',$total)
        ->with('reli',$reli)->with('review',$this->returnRandomReview($id));
        // return view('profile',['user' => $user]);
    }
}
