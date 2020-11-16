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
            // dd($bandInfo);
            $search = $req->input('Search');
            $results = \App\User::where('name', 'like', $search .'%')->get();
            $amount = Count($results);
            $about = $this->searchResults($results);
            return view('search')->withDetails($search)->with('search',$search)->with('results',$results)->with('amount',$amount)
            ->with('info',$about)->with('bandId',$bandIds)->with('bandInfo',$bandInfo);
        }else{
            return view('search')->with('amount',0);
        }
    }
}
