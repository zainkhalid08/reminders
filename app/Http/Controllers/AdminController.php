<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Shows the admin's dashboard
     * 
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        // $tags = auth()->user()->tags;
        // dd($tags);
        
        // $stats = tagging_progress(auth()->user());

        return view('admin.welcome');
    }

}
