<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function welcome(Request $request)
    {
        $meta = [
            'description' =>   'Older friday sermons of masjid al haram.',
        ];

        $posts = Post::latestPublishedFirst()->limit(config('post.welcome'))->get();
    	$total = $posts->count();
	    return view('welcome', compact('posts', 'total', 'meta'));
    }
}
