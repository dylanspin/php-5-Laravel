<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
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


    public function index()
    {
        return view('search');
    }

    private function searchResults($result)
    {
        $aboutArray = array();
        if(!empty($_COOKIE["testCoockie"]))
        {
          echo $_COOKIE["testCoockie"];
        }
        for($i=0; $i<Count($result); $i++)
        {
            $information = \App\profile::findOrFail($result[$i]->id);
            array_push($aboutArray,$information->about);
        }

        return $aboutArray;
    }
    private function getBandIds()
    {
        $id = auth()->user()->id;
        $information = \App\profile::findOrFail($id);
        $bandIDs = unserialize($information->bands);
        if(!empty($bandIDs))
        {
            return $bandIDs;
        }else{
            return null;
        }
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

    private function getBandProfile($bands)
    {
        $bandProfile = array();

        for($i=0; $i<Count($bands); $i++)
        {
            if(Count($bands) > 0)
            {
                array_push($bandProfile,[\App\bandprofile::where('id',$bands[$i]->id)->get()]);
            }else{
                $bandProfile = [\App\bandprofile::where('id',$bands[$i]->id)->get()];
            }
        }

        return $bandProfile;
    }

    public function formSubmit(Request $req)
    {
        if($req)
        {
            $bandIds = $this->getBandIds();
            if($bandIds != null)
            {
                $bandInfo = $this->getBandInfo($bandIds);
            }else{
                $bandInfo = null;
            }
            $search = $req->input('Search');
            $results = \App\User::where('name', 'like', $search .'%')->get();
            $bandResults = \App\band::where('bandName', 'like', $search .'%')->get();
            $bandProfile = $this->getBandProfile($bandResults);
            $about = $this->searchResults($results);
            
            return view('search')->withDetails($search)->with('search',$search)->with('results',$results)->with('profile',$bandProfile)
            ->with('info',$about)->with('bandId',$bandIds)->with('bandInfo',$bandInfo)->with('bandResults',$bandResults);
        }else{
            return view('search')->with('amount',0);
        }
    }
}
