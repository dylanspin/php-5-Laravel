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

    public function searchResults($s)
    {

    }

    public function formSubmit(Request $req)
    {
        if($req)
        {
            $search = $req->input('Search');
            $results = \App\User::where('name', 'like', $search .'%')->get();
            $amount = Count($results);
            return view('search')->withDetails($search)->with('search',$search)->with('results',$results)->with('amount',$amount);
            // return view('search',['search' => $search]);
        }else{
            return view('search');
        }
    }
}
