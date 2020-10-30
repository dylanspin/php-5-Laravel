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
        $bands = \App\band::where('id',$bandIDs)->get();
        $bandInformation = array();
        for($i=0; $i<Count($bandIDs); $i++)
        {
            if(Count($bandInformation) > 1)
            {
                array_push($bandInformation,  [\App\band::where('id',$bandIDs[$i])->get()]);
            }else{
                $bandInformation = [\App\band::where('id',$bandIDs[$i])->get()];
            }
        }
        // dd($bandInformation[0]);
        return $bandInformation;
    }

    public function index()
    {
        $id = auth()->user()->id;
        $information = \App\profile::findOrFail($id);
        if(strlen($information->bands) > 0)
        {
            $bandIDs = unserialize($information->bands);
            $bandInformation = $this->getBandInfo($bandIDs);
            $hasBand = true;
        }else{
            $bandInformation = null;
            $hasBand = false;
        }
        return view('band')->with('has',$hasBand)->with('bands',$bandInformation);
    }

    //for booking a band or product
    public function book($productId)
    {
        return view('band')->with('information',$information);
    }
}
