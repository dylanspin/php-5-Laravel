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

    private $messages = ["message send","cant invite your self","Person is already in the band","Cant leave becouse your still the owner",
                          "You dont have to permision to invite people to this band","You dont have to permision to promote"];

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
            $sendId = auth()->user()->id;
            $idInvite = $req['inviteId'];
            $bandId = $req['bandId'];
            $bandInformation = \App\band::where('id',$bandId)->get();
            $list = $bandInformation[0]->members;
            $perms = unserialize($bandInformation[0]->memberPer);
            $list = unserialize($list);
            $mySlot = array_search($sendId,$list);
            if($perms[$mySlot] > 0)
            {
                if(empty($list)){
                    $notIn = true;
                }else{
                    if(Count($list) > 0)
                    {
                        if(in_array($idInvite, $list))
                        {
                            $notIn = false;
                        }else{
                            $notIn = true;
                        }
                    }else{
                        if($list[0] != $idInvite)
                        {
                            $notIn = false;
                        }else{
                            $notIn = true;
                        }
                    }
                }
                if($notIn)
                {
                    if($sendId != $idInvite)
                    {
                        $message = new \App\message;
                        $message->type = 0;
                        $message->bandId = $bandId;
                        $message->sendId = $sendId;
                        $message->recieve = $idInvite;
                        $message->save();
                        setcookie("message", 0);//message send
                    }else{
                        setcookie("message", 1);//cant invite your self
                    }
                }else{
                    setcookie("message", 2);//Person is already in the band
                }
            }else{
                setcookie("message", 4);//No permision to invite
            }
        }
        return $this->index();
    }

    private function createBandProfile($setID)
    {
        $profile = new \App\bandprofile;
        $profile->about = "No user information";
        $profile->image = "";
        $profile->social = "";
        $profile->gradient = "";
        $profile->font = 0;
        $profile->id = $setID;
        $profile->songTexts = "";
        $profile->vids = "";
        $profile->save();
    }


    private function leave($id,$bandId)
    {
        $information = \App\profile::findOrFail($id);
        $bandIds = unserialize($information->bands);
        $bandInfo = \App\band::findOrFail($bandId);
        $members = unserialize($bandInfo->members);
        $perms = unserialize($bandInfo->memberPer);
        $memberSlot = array_search($id,$members);
        $slot = array_search($bandId,$bandIds);
        $canLeave = true;
        if(Count($members) > 1)
        {
            $mySlot = array_search($id,$members);
            if($perms[$mySlot] == 3)
            {
                $canLeave = false;
                setcookie("message", 3);//cant leave becouse your still the owner
            }
        }
        if($canLeave)
        {
            unset($bandIds[$slot]);
            unset($members[$memberSlot]);
            unset($perms[$memberSlot]);

            // resetArray
            $bandIds = $this->resetArray($bandIds);
            $members = $this->resetArray($members);
            $perms = $this->resetArray($perms);

            if(empty($bandIds))
            {
                $compressedBands = null;
            }else{
                $compressedBands = serialize($bandIds);
            }

            if(empty($members))
            {
                \App\band::where('id', $bandId)->delete();
                \App\bandprofile::where('id', $bandId)->delete();
            }else{
                $compressedMembers = serialize($members);
                $compressedPerms = serialize($perms);

                $band = new \App\band;
                $band -> where('id',$bandId)->update(['members' => $compressedMembers,'memberPer' => $compressedPerms]);
            }

            $profile = new \App\profile;
            $profile -> where('id',$id)->update(['bands' => $compressedBands]);
        }
    }

    public function leaveBand(Request $req)
    {
        if($req)
        {
            $id = auth()->user()->id;
            $information = \App\profile::findOrFail($id);
            $bandIds = unserialize($information->bands);
            $slot = $req['slot'];
            $bandId = $bandIds[$slot];
            $this->leave($id,$bandId);
        }
        return back();
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
        }
        return back();
    }

    public function SubmitSettings(Request $req)
    {
        if($req)
        {
            $id = auth()->user()->id;
            $information = \App\profile::findOrFail($id);
            $bandIds = unserialize($information->bands);
            $slot = $req['slot'];
            $bandId = $bandIds[$slot];

            $socialLinksArray = [$req['Instagram'], $req['Twitter'], $req['Facebook'], $req['Linkedin'], $req['Youtube'], $req['Custom']];
            $compresSocial = serialize($socialLinksArray);

            $settings = new \App\bandprofile;
            $settings -> where('id', $bandId)->update(['about' => $req['about'],'social' => $compresSocial]);
            $this->UploadImage($req,$bandId);
        }

        return back();
    }

    private function UploadImage(Request $req,$id)
    {
         $settings = new \App\bandprofile;
         $information = \App\bandprofile::findOrFail($id);

         $req->validate([
             'profileImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
         ]);

         $destinationPath = 'publicImages/images/BandProfile/';
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
            $id = auth()->user()->id;
            $bandslot = $req['slot'];
            $information = \App\profile::findOrFail($id);
            $bandIds = unserialize($information->bands);
            $bandId = $bandIds[$bandslot];

            $gradientArray = [$req['gradient1'], $req['gradient2']];
            $compresGradient = serialize($gradientArray);

            if($req['font'])
            {
                $font = $req['font'];
            }else{
                $information = \App\bandprofile::where('id',$bandId)->get();
                $font = $information->font;
            }

            $settings = new \App\bandprofile;
            $settings -> where('id', $bandId)->update(['gradient' => $compresGradient, 'font' => $font]);
        }

        return back();
    }

    public function SubmitVids(Request $req)
    {
        if($req)
        {
            $id = auth()->user()->id;
            $bandslot = $req['slot'];
            $information = \App\profile::findOrFail($id);
            $bandIds = unserialize($information->bands);
            $bandId = $bandIds[$bandslot];
            $bandInfo = \App\bandprofile::where('id',$bandId)->get();
            $arraySlot = $req['aSlot'];

            $current = $bandInfo[0]->vids;
            if(strlen($current) < 1){
                $current = ["","",""];
            }else{
                $current = unserialize($current);
            }
            $current[$arraySlot] = $req['vidLink'];
            $compressedVids = serialize($current);

            $settings = new \App\bandprofile;
            $settings -> where('id', $bandId)->update(['vids' => $compressedVids]);
        }

        return back();
    }


    public function resetArray($array)
    {
        $newArray = array();

        for($i=0; $i<=Count($array); $i++)
        {
            if(array_key_exists($i, $array))
            {
                if(!empty($newArray))
                {
                    array_push($newArray,$array[$i]);
                }else{
                    $newArray[0] = $array[$i];
                }
            }
        }

        return $newArray;
    }

    public function promote(Request $req)
    {
        if($req)
        {
            $id = auth()->user()->id;
            $information = \App\profile::findOrFail($id);
            $slot = $req['slot'];
            $bandMember = $req['member'];
            $newPerm = $req['perms'];
            $bandIds = unserialize($information->bands);
            $bandId = $bandIds[$slot];
            $bandInfo = \App\band::where('id',$bandId)->get();
            $members = unserialize($bandInfo[0]->members);
            $SetSlot = array_search($bandMember,$members);
            $mySlot = array_search($id,$members);
            $perms = unserialize($bandInfo[0]->memberPer);
            $myPerm = $perms[$mySlot];

            if($myPerm > 1)
            {
                if($newPerm == 3)
                {
                    $perms[$SetSlot] = $newPerm;
                    $perms[$mySlot] = 2;
                }else{
                    $perms[$SetSlot] = $newPerm;
                }

                $compressedPerms = serialize($perms);
                $band = new \App\band;
                $band -> where('id',$bandId)->update(['memberPer' => $compressedPerms]);
            }else{
                setcookie("message", 5);//No permision
            }
        }

        return back();
    }

    public function kickMember(Request $req)
    {
        if($req)
        {
            $id = auth()->user()->id;
            $information = \App\profile::findOrFail($id);
            $bandIds = unserialize($information->bands);
            $slot = $req['slot'];
            $bandMember = $req['member'];
            $bandId = $bandIds[$slot];
            $bandInfo = \App\band::where('id',$bandId)->get();
            $members = unserialize($bandInfo[0]->members);
            $memberId = $members[$bandMember];
            $this->leave($memberId,$bandId);
        }
        return back();
    }

    private function getSocial($bandProfile)
    {
        $socials = array();

        for($i=0; $i<Count($bandProfile); $i++)
        {
            if(strlen($bandProfile[$i][0][0]->social) < 1){
                $socialLinks = ["","","","","",""];
            }else{
                $socialLinks = unserialize($bandProfile[$i][0][0]->social);
            }
            array_push($socials,$socialLinks);
        }

        return $socials;
    }

    private function getVids($bandProfile)
    {
        $vids = array();

        for($i=0; $i<Count($bandProfile); $i++)
        {
            if(strlen($bandProfile[$i][0][0]->vids) < 1){
                $vidArray = ["","",""];
            }else{
                $vidArray = unserialize($bandProfile[$i][0][0]->vids);
            }
            array_push($vids,$vidArray);
        }

        return $vids;
    }

    private function getBandProducts($bandIDs)
    {
        $bandProducts = array();

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
                        $name = \App\User::findOrFail($list[$b])->name;
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

    private function getMyPerms($bandMembers,$amount)
    {
        $myPerms = array();
        $id = auth()->user()->id;
        $name = \App\User::findOrFail($id)->name;
        for($i=0; $i<$amount; $i++)
        {
            $slot = array_search($name,$bandMembers[$i]);
            array_push($myPerms,$slot);
        }

        return $myPerms;
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
        for($i=0; $i<Count($bandIDs); $i++)
        {
            if(Count($bandIDs) > 0)
            {
                $information = \App\bandprofile::where('id',$bandIDs[$i])->get();
                if(strlen($information[0]->gradient) < 1){
                    $gradient = ["#780206","#061161"];
                }else{
                    $gradient = unserialize($information[0]->gradient);
                }
                array_push($bandGradients,$gradient);
            }else{
                $information = \App\bandprofile::where('id',$bandIDs[$i])->get();
                if(strlen($information[0]->gradient) < 1){
                    $gradient = ["#780206","#061161"];
                }else{
                    $gradient = unserialize($information[0]->gradient);
                }
                $bandGradients = [$gradient];
            }
        }

        return $bandGradients;
    }

    public function getMessage()
    {
        if(!empty($_COOKIE["message"]))
        {
            $message = $this->messages[$_COOKIE["message"]];
            setcookie("message", "", 1,"/band");
        }else{
            $message = null;
        }

        return $message;
    }


    public function index()
    {
        $id = auth()->user()->id;
        $information = \App\profile::findOrFail($id);
        if(strlen($information->bands) > 0)
        {
            $bandIDs = unserialize($information->bands);
            $bandInformation = $this->getBandInfo($bandIDs);
            $bandProfile = $this->getBandProfile($bandIDs);
            $members = $this->getBandNames($bandIDs);
            $gradients = $this->getBandGradients($bandIDs);
            $perms = $this->getBandPerms($bandIDs);
            $products = $this->getBandProducts($bandIDs);
            $myPerms = $this->getMyPerms($members,Count($bandIDs));
            $hasBand = true;
            // dd($bandProfile);
            $socials = $this->getSocial($bandProfile);
            $vids = $this->getVids($bandProfile);
        }else{
            $bandInformation = null;
            $hasBand = false;
            $bandIDs = null;
            $perms = null;
            $members = null;
            $products = null;
            $bandProfile = null;
            $gradients = null;
            $myPerms = null;
            $socials = null;
            $vids = null;
        }

        return view('band')->with('has',$hasBand)->with('bands',$bandInformation)->with('Ids',$bandIDs)->with('perms',$perms)
        ->with('members',$members)->with('products',$products)->with('gradients',$gradients)->with('vids',$vids)
        ->with('message',$this->getMessage())->with('myPerm',$myPerms)->with('social',$socials)->with('profile',$bandProfile);
    }

}
