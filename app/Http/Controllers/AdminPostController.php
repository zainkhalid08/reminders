<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Location;
use App\Speaker;
use App\Tag;
use Illuminate\Http\Request;

class AdminPostController extends Controller
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
    public function create()
    {
        // $tags = auth()->user()->tags;
        // dd($tags);
        
        // $stats = tagging_progress(auth()->user());
        $tags = Tag::all();
        $speakers = Speaker::all();
        $locations = Location::all();


        return view('admin.post.create', compact('tags', 'speakers', 'locations'));
    }

    /**
     * @param \App\Http\Requests\PostStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
    	dd('passed');
        $post = Post::create($request->all());

        event(new NewPost($post));

        $request->session()->flash('post.title', $post->title);

        return redirect()->route('post.index');
    }

}
