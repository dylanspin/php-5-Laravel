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
     //moet voor show all reviews
    public function index($user)
    {
        $results = \App\review::where('id',$req['pageId'])->get();
        $amount = Count($results);
        return view('reviews')->with('results',$results)->with('returnId',$req['pageId'])->with('amount',$amount);
    }

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


    //Settings functions
    public function formSubmitSettings(Request $req)
    {
        if($req)
        {
            $id = auth()->user()->id;

            $about = $req['about'];
            $socialLinksArray = [$req['Instagram'], $req['Twitter'], $req['Facebook'], $req['Linkedin'], $req['Youtube'], $req['Custom']];
            $compresSocial = serialize($socialLinksArray);

            $settings = new \App\profile;
            $settings -> where('id', $id)->update(['about' => $about,'social' => $compresSocial]);
            $this->UploadImage($req,$id);
        }

        return back();
    }

    private function UploadImage(Request $req,$id)
    {
         $settings = new \App\profile;
         $information = \App\profile::findOrFail($id);

         if($information->image != $req['profileImage'])
         {
             $req->validate([
                 'profileImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             ]);

             $destinationPath = 'publicImages/images/Profile/';
             $file = $req->file('profileImage');
             $file_name =  time().'.'.$req->file('profileImage')->extension();

             $oldImage = $information->image;
             if (file_exists($destinationPath.$oldImage))
             {
                unlink($destinationPath.$oldImage);
             }
             $file->move($destinationPath,$file_name);
             $settings -> where('id', $id)->update(['image' => $file_name]);
         }
    }

    public function uploadVid(Request $req)
    {
        if($req)
        {
            $id = auth()->user()->id;
            $information = \App\profile::findOrFail($id);
            $arraySlot = $req['aSlot'];
            $current = $information->vids;
            if(strlen($current) < 1){
                $current = ["","",""];
            }else{
                $current = unserialize($current);
            }
            $current[$arraySlot] = $req['vidLink'];
            $compressedVids = serialize($current);

            $settings = new \App\profile;
            $settings -> where('id', $id)->update(['vids' => $compressedVids]);
        }

        return back();
    }

    public function formSubmitStyle(Request $req)
    {
        if($req)
        {
            $id = auth()->user()->id;
            $information = \App\profile::findOrFail($id);

            $gradientArray = [$req['gradient1'], $req['gradient2']];
            $compresGradient = serialize($gradientArray);

            if($req['font'])
            {
                $font = $req['font'];
            }else{
                $font = $information->font;
            }

            $settings = new \App\profile;
            $settings -> where('id', $id)->update(['gradient' => $compresGradient, 'font' => $font]);

            return back();
        }else{
            return back();
        }
    }

    private function UploadProductImage(Request $req)
    {
         $id = auth()->user()->id;

         $req->validate([
             'productImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);

         $destinationPath = 'publicImages/images/Products/';
         $file = $req->file('productImage');
         $file_name =  time().'.'.$req->file('productImage')->extension();

         $file->move($destinationPath,$file_name);

         return $file_name;
    }


}
