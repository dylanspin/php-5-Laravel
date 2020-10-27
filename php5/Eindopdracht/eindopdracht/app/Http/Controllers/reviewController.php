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
            $user = auth()->user();

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

    public function submitProduct(Request $req)
    {
        if($req)
        {
            $id = auth()->user()->id;
            $products = new \App\bandproduct;
            $selected = $req['selected'];
            if(!empty($req['productName']))
            {
                $products->productName = $req['productName'];
            }else{
                $products->productName = "No Name";
            }
            if(!empty($req['productImage']))
            {
                $imageName = $this->UploadProductImage($req);
            }else{
                $imageName = "0";
            }
            if(!empty($req['youtubeProduct']))
            {
              $vid = $req['youtubeProduct'];
            }else{
              $vid = " ";
            }
            if($selected == 1)
            {
                $products->price = $req['hourPrice'];
            }else{
                $products->price = 0;
            }
            if(!empty($req['productAbout']))
            {
              $products->postText = $req['productAbout'];
            }else{
              $products->postText = " ";
            }
            $products->vidLink = $vid;
            if($imageName != 0)
            {
                $products->imgName = $imageName;
            }else{
                $products->imgName = 0;
            }

            if(!empty($req['basePrice']))
            {
                $products->basePrice = $req['basePrice'];
            }else{
                $products->basePrice = 0;
            }
            $products->type = $selected;
            $products->idPoster = $id;
            $products->save();

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
