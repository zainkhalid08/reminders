<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Location;
use App\Post;
use App\Speaker;
use App\Tag;
use App\Traits\CombinePostUpdateOrCreate;
use App\Traits\PostViewHelper;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    use CombinePostUpdateOrCreate, PostViewHelper;

    /**
     * Shows ALL posts(published and unpublished)
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$posts = Post::latest('updated_at')->get();
        return view('admin.post.index', ['posts' => $posts]);
    }

    /**
     * Shows the post creation page
     *
     * @var   $availableData[]
     * @var   $formSettings[] 
     *  
     * @see App\Providers\ViewServiceProvider
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.post.create_or_update');
    }

    /**
     * Stores the post in db
     * 
     * @param \App\Http\Requests\PostStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostStoreRequest $request)
    {
    	$this->updateOrCreate();

        return redirect()->route('admin.post.index');
    }

    /**
     * Shows the same post creation page
     *
     * @var   $availableData[]
     * @var   $formSettings[] 
     *  
     * @see App\Providers\ViewServiceProvider
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Post $post)
    {
        return view('admin.post.create_or_update', compact('post'));
    }

    public function update(PostStoreRequest $request, Post $post)
    {
    	$this->updateOrCreate($post);

        return redirect()->route('admin.post.index');
    }

}
