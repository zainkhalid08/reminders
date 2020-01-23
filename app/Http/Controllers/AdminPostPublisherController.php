<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class AdminPostPublisherController extends Controller
{
    /**
     * Publishes the post
     *
     * @param App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function publish(Post $post)
    {
    	$post->publish();
    	return back();
    }
}
