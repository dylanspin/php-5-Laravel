<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReviewController extends Controller
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

    function returnProfile()
    {
        $information = \App\profile::findOrFail($user);
        $total = $information->completed + $information->failed;
        $reli = round(100 / $total * $information->completed);
        $user = \App\User::findOrFail($user); //$user is wat er naar de profile/ word gezet voor verschillende accounts
        return view('profile')->withDetails($user)->with('information',$information)->with('user',$user)->with('total',$total)->with('reli',$reli);
    }

    public function formSubmit(Request $req)
    {
    		try{
      			$review = new review;
            $review->review = $req['review'];
            $review->rating = $req['stars'];
      			$review->idUserPage = $req['pageId'];
      			$review->idPoster = Auth::user()->id;
      			$review->save();
      			returnProfile();
    		}
    		catch(Exception $e){
            returnProfile();
    			// return redirect('profile')->with('failed',"operation failed");
    		}
		}

        // if($req)
        // {
        //     $review = $req->input('review');
        //     $stars = $req->input('stars');
        //     echo " Stars : ".$stars." Review : ".$review;
        //     //moet nog alle andere reviews van deze user pakken en er moet een thank you message staan voor de review ook moet er
        //     //een return button zijn naar de profile waar je nu de reviews van bekijkt. wat ik dan ook kan gaan gebruiken voor de search
        //     return view('reviews');
        // }else{
        //     returnProfile();
        // }
}
