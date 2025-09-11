<?php

namespace App\Http\Controllers;

use App\Feedback;
use App\Tag;
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

    /**
     * Shows all feedbacks received
     * 
     * @return \Illuminate\Http\Response
     */
    public function feedbacks()
    {
    	$feedbacks = Feedback::latest()->get();
        return view('admin.feedbacks', ['feedbacks' => $feedbacks]);
    }

    /**
     * Shows all tags received
     * 
     * @return \Illuminate\Http\Response
     */
    public function tags()
    {
        $tags = Tag::latest()->get();
        return view('admin.tags', ['tags' => $tags]);
    }

}
