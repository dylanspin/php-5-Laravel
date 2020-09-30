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

    public function formSubmit(Request $req)
    {
    		try{
      			$review = new \App\review;
            $review->review = $req['review'];
            $review->rating = $req['stars'];
      			$review->idUserPage = $req['pageId'];
      			$review->idPoster = auth()->user()->id;
      			$review->save();
            return back();
    		}
    		catch(Exception $e){
            return back();
    		}
		}

    //moet voor show all reviews
    public function index($user)
    {
        $results = \App\review::where('id',$req['pageId'])->get();
        $amount = Count($results);
        return view('reviews')->with('results',$results)->with('returnId',$req['pageId'])->with('amount',$amount);
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
