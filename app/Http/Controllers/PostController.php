<?php

namespace App\Http\Controllers;

use App\Events\NewPost;
use App\Http\Requests\PostShowRequest;
use App\Http\Requests\PostStoreRequest;
use App\Post;
use App\Traits\SeoHelper;
use Illuminate\Http\Request;

class PostController extends Controller
{
    use SeoHelper;

    /**
     * Shows all PUBLISHED posts
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $seo = [
            'title' => config('seo.post-index.title'),
            'meta' => config('seo.post-index.meta'),
        ];
        $seo = $this->mergeWithTemplate($seo);

        $publishedPosts = Post::published();

        $posts = $publishedPosts->latest('published_at')->paginate(config('post.post-index'));

        return view('post.index', compact('posts', 'seo'));
    }

    /**
     * Shows a single post
     * 
     * @param \App\Http\Requests\PostShowRequest $request
     * @param \App\Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(PostShowRequest $request, Post $post)
    {
        return view('post.show', ['post' => $post]);
    }
}
