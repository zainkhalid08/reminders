<?php

namespace App\Http\Controllers;

use App\Events\NewPost;
use App\Http\Requests\PostStoreRequest;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::published()->latest()->get();

        return view('post.index', compact('posts'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Post $post)
    {
        // unpublished and guest or 
        // unpublished and auth and email_different or
        // unpublished and auth and email_different and password_diff

        if ($post->isUnpublished() && auth()->guest()) {
            abort(404);
        }
        return view('post.show', ['post' => $post]);
    }
}
