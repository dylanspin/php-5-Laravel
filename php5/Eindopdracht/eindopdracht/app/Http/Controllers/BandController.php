<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BandController extends Controller
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

    private function setNewBands($information,$newID,$id)
    {
        $current = $information->bands;
        if(strlen($current) > 0)
        {
            $list = unserialize($current);
            array_push($list,$newID);
            $compressedList = serialize($list);
        }else{
          $list = array($newID);
          $compressedList = serialize($list);
        }
        $settings = new \App\profile;
        $settings -> where('id', $id)->update(['bands' => $compressedList]);
    }

    public function createBand(Request $req)
    {
        if($req)
        {
            $id = auth()->user()->id;
            $settings = new \App\profile;
            $band = new \App\band;
            $information = \App\profile::findOrFail($id);
            if(strlen($req['bandName']) > 1)
            {
                $members = array($id);
                $per = array(3);
                $compresMembers = serialize($members);
                $compresPer = serialize($per);
                $band->bandName = $req['bandName'];
                $band->members = $compresMembers;
                $band->memberPer = $compresPer;
                $band->followers = "";
                $band->save();
                $idset = $band->id;
                $this->setNewBands($information,$idset,$id);
                $this->createBandProfile($idset);
                return back();
            }else{
                  return back();
            }
        }else{
            return back();
        }
    }

    public function invite(Request $req)
    {
        if($req)
        {
            $idInvite = $req['inviteId'];
            // $invitelist = explode(',',$req['list']);
            $invitelist = json_decode($req['list'], true);
            setcookie("testCoockie",Count($invitelist));
            // return back();
        }else{
            // return back();
        }
    }

    private function createBandProfile($setID)
    {
        $review = new \App\bandprofile;
        $review->about = "No user information";
        $review->image = "";
        $review->social = "";
        $review->gradient = "";
        $review->font = 0;
        $review->id = $setID;
        $review->songTexts = "";
        $review->save();
    }

    public function submitProduct(Request $req)
    {
        if($req)
        {
            $setBand = $req['BandId'];
            $info = \App\profile::findOrFail(auth()->user()->id);
            $array = unserialize($info->bands);
            $set = $array[$setBand];

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
            $products->idPoster = $set;
            $products->save();

            return back();
        }else{
            return back();
        }
    }

    private function getBandProducts($bandIDs)
    {
        $bandProducts = array();
        // $bandInformation = \App\band::where('id',$bandIDs[0])->get();

        for($i=0; $i<Count($bandIDs); $i++)
        {
            if(Count($bandIDs) > 0)
            {
                $products = \App\bandproduct::where('idPoster',$bandIDs[$i])->get();
                array_push($bandProducts,$products);
            }else{
                $products = \App\bandproduct::where('idPoster',$bandIDs[$i])->get();
                $bandProducts = [$products];
            }
        }

        return $bandProducts;
    }

    private function getBandInfo($bandIDs)
    {
        $bandInformation = array();
        // $bandInformation = \App\band::where('id',$bandIDs[0])->get();

        for($i=0; $i<Count($bandIDs); $i++)
        {
            if(Count($bandIDs) > 0)
            {
                array_push($bandInformation,[\App\band::where('id',$bandIDs[$i])->get()]);
            }else{
                $bandInformation = [\App\band::where('id',$bandIDs[$i])->get()];
            }
        }
        return $bandInformation;
    }

    private function getBandProfile($bandIDs)
    {
        $bandProfile = array();

        for($i=0; $i<Count($bandIDs); $i++)
        {
            if(Count($bandIDs) > 0)
            {
                array_push($bandProfile,[\App\bandprofile::where('id',$bandIDs[$i])->get()]);
            }else{
                $bandProfile = [\App\bandprofile::where('id',$bandIDs[$i])->get()];
            }
        }

        return $bandProfile;
    }

    private function getBandNames($bandIDs)
    {
        $bandNames = array();

        for($i=0; $i<Count($bandIDs); $i++)
        {
            if(Count($bandIDs) > 0)
            {
                $information = \App\band::where('id',$bandIDs[$i])->get();
                $list = unserialize($information[0]->members);
                $tempArray = array();
                for($b=0; $b<Count($list); $b++)
                {
                    if(Count($list) > 1)
                    {
                        $name = $user = \App\User::findOrFail($list[$b])->name;
                        array_push($tempArray,$name);
                    }else{
                        $tempArray = [\App\User::findOrFail($list[$b])->name];
                    }
                }
                array_push($bandNames,$tempArray);
            }else{
                $information = \App\band::where('id',$bandIDs[$i])->get();
                $bandNames = [unserialize($information[0]->members)];
            }
        }

        return $bandNames;
    }

    private function getBandPerms($bandIDs)
    {
        $bandPerms = array();

        for($i=0; $i<Count($bandIDs); $i++)
        {
            if(Count($bandIDs) > 0)
            {
                $information = \App\band::where('id',$bandIDs[$i])->get();
                array_push($bandPerms,unserialize($information[0]->memberPer));
            }else{
                $information = \App\band::where('id',$bandIDs[$i])->get();
                $bandPerms = [unserialize($information[0]->memberPer)];
            }
        }

        return $bandPerms;
    }

    private function getBandGradients($bandIDs)
    {
        $bandGradients = array();
        // $information = \App\bandprofile::findOrFail($bandIDs[0]);
        for($i=0; $i<Count($bandIDs); $i++)
        {
            if(Count($bandIDs) > 0)
            {
                // $information = \App\bandprofile::findOrFail($bandIDs[$i]);
                // echo $bandIDs[$i]." ";
                $information = \App\bandprofile::where('id',$bandIDs[$i])->get();
                // dd($information);
                // dd($information);
                if(strlen($information[0]->gradient) < 1){
                    $gradient = ["#780206","#061161"];
                }else{
                    $gradient = unserialize($information->gradient);
                }
                // $gradient = ["#780206","#061161"];
                array_push($bandGradients,$gradient);
            }else{
                $information = \App\bandprofile::where('id',$bandIDs[$i])->get();
                if(strlen($information[0]->gradient) < 1){
                    $gradient = ["#780206","#061161"];
                }else{
                    $gradient = unserialize($information->gradient);
                }
                // $gradient = ["#780206","#061161"];
                $bandGradients = [$gradient];
            }
        }

        return $bandGradients;
    }


    public function index()
    {
        $id = auth()->user()->id;
        $information = \App\profile::findOrFail($id);
        if(strlen($information->bands) > 0)
        {
            // $products = \App\bandproduct::where('idPoster',$id)->get();
            $bandIDs = unserialize($information->bands);
            $bandInformation = $this->getBandInfo($bandIDs);
            $bandProfile = $this->getBandProfile($bandIDs);
            $members = $this->getBandNames($bandIDs);
            $gradients = $this->getBandGradients($bandIDs);
            $perms = $this->getBandPerms($bandIDs);
            $products = $this->getBandProducts($bandIDs);

            $hasBand = true;
        }else{
            $bandInformation = null;
            $hasBand = false;
            $bandIDs = null;
            $perms = null;
            $members = null;
            $products = null;
            $bandProfile = null;
            $gradients = null;
        }

        return view('band')->with('has',$hasBand)->with('bands',$bandInformation)->with('Ids',$bandIDs)->with('perms',$perms)
        ->with('members',$members)->with('products',$products)->with('profile',$bandProfile)->with('gradients',$gradients);
    }

}
