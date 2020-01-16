<?php

namespace App\Http\Controllers;

use App\Events\NewPost;
use App\Http\Requests\PostShowRequest;
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
        $meta = [
            'description' =>   'Older friday sermons of masjid al haram.',
        ];

        $posts = Post::latestPublishedFirst()->get();
        // dd($posts);

        return view('post.index', compact('posts', 'meta'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(PostShowRequest $request, Post $post)
    {
        return view('post.show', ['post' => $post]);
    }
}
