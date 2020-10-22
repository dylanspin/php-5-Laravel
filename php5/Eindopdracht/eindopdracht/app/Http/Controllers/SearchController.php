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
        for($i=0; $i<Count($result); $i++)
        {
            $information = \App\profile::findOrFail($result[$i]->id);
            array_push($aboutArray,$information->about);
        }
        
        return $aboutArray;
    }

    public function formSubmit(Request $req)
    {
        if($req)
        {
            $search = $req->input('Search');
            $results = \App\User::where('name', 'like', $search .'%')->get();
            $amount = Count($results);
            $about = $this->searchResults($results);
            return view('search')->withDetails($search)->with('search',$search)->with('results',$results)->with('amount',$amount)
            ->with('info',$about);
        }else{
            return view('search')->with('amount',0);
        }
    }
}
