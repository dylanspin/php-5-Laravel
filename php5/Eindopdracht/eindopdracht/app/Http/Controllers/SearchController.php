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

    public function formSubmit(Request $req)
    {
        if($req)
        {
            $search = $req->input('Search');
            return view('search',['search' => $search]);

            $sql = "select * from users where name LIKE '%$search%'";
            $results = \App\User::select($sql, [1]);
            return View::share($results);

        }else{
          //moet nog iets zeggen geen search result
        }
    }
}
