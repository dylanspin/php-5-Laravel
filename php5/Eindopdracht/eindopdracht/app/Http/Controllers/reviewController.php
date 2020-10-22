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

    public function formSubmitSettings(Request $req)
    {
        if($req)
        {
            $user = auth()->user();

            // $req->validate([
            //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);

            $socialLinksArray = [$req['Instagram'], $req['Twitter'], $req['Facebook'], $req['Linkedin'], $req['Youtube'], $req['Custom']];
            $compresSocial = serialize($socialLinksArray);

            $this->UploadImage($req);
            $settings = new \App\profile;
            $settings -> where('id', $user->id)->update(['about' => $req['about'],'social' => $compresSocial]);
            return back();

        }else{
            return back();
        }
    }

    private function UploadImage(Request $req)
    {
         $settings = new \App\profile;
         $id = auth()->user()->id;
         $information = \App\profile::findOrFail($id);
         $userInfo = \App\User::findOrFail($id);
         $nameUser = $userInfo->name;

         $req->validate([
             'profileImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);

         $destinationPath = 'publicImages/images/Profile/';
         $file = $req->file('profileImage');
         $file_name = $file->getClientOriginalName();
         $nameImage = $nameUser.$file_name;
         setcookie("myCookie", $nameUser, time() + 3600);
         $oldImage = $information->image;
         if (file_exists(public_path().$oldImage))
         {
           $file->delete($destinationPath,$oldImage);
         }
         $file->move($destinationPath , $file_name);
         rename($destinationPath.$file_name,$destinationPath.$nameImage);
         $settings -> where('id', $id)->update(['image' => $nameImage]);
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
