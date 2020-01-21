<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    /**
     * Shows the admin's dashboard
     * 
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        return view('admin.welcome');
    }

}
