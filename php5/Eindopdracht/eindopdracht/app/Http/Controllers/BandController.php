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
                return back();
            }else{
                  return back();
            }
        }else{
            return back();
        }
    }

    private function getBandInfo($bandIDs)
    {
        $bandInformation = array();
        // $bandInformation = \App\band::where('id',$bandIDs[0])->get();

        for($i=0; $i<Count($bandIDs); $i++)
        {
            if(Count($bandIDs) > 1)
            {
                array_push($bandInformation,[\App\band::where('id',$bandIDs[$i])->get()]);
            }else{
                $bandInformation = [\App\band::where('id',$bandIDs[$i])->get()];
            }
        }
        return $bandInformation;
    }

    private function getBandNames($bandIDs)
    {
        $bandNames = array();
        // $bandInformation = \App\band::where('id',$bandIDs[0])->get();

        for($i=0; $i<Count($bandIDs); $i++)
        {
            if(Count($bandIDs) > 1)
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
            if(Count($bandIDs) > 1)
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


    public function index()
    {
        $id = auth()->user()->id;
        $information = \App\profile::findOrFail($id);
        if(strlen($information->bands) > 0)
        {
            $bandIDs = unserialize($information->bands);
            // $bandInformation = \App\band::where('id',$bandIDs[0])->get();
            $bandInformation = $this->getBandInfo($bandIDs);
            $members = $this->getBandNames($bandIDs);
            $perms = $this->getBandPerms($bandIDs);
            $hasBand = true;
        }else{
            $bandInformation = null;
            $hasBand = false;
        }

        return view('band')->with('has',$hasBand)->with('bands',$bandInformation)->with('Ids',$bandIDs)->with('perms',$perms)
        ->with('members',$members);
    }

}
