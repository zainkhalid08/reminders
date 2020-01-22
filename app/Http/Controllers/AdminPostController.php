<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Jobs\ProcessPostContent;
use App\Location;
use App\Post;
use App\Speaker;
use App\Tag;
use App\Traits\PostViewHelper;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{
    use PostViewHelper;

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
    	$response = $this->storeOrUpdate($request);

    	if ($response['failed']) {
    		return back()->withErrors([ $response['entity'] => 'Duplicate '.$response['entity'] ]);
    	}
        // dd('hit hwer');
        // event(new NewPost($post));

        return redirect()->route($response['url']);
    }

    public function edit(Request $request, Post $post)
    {
        return view('admin.post.create_or_update', compact('post'));
    }

    public function update(PostStoreRequest $request, Post $post)
    {
    	$response = $this->storeOrUpdate($request, $post);
    	// dd($response);

    	if ($response['failed']) {
    		return back()->withErrors([ $response['entity'] => 'Duplicate '.$response['entity'] ]);
    	}

        // event(new NewPost($post));

        return redirect()->route($response['url']);

    }

    public function publish(Post $post)
    {
    	$post->publish();
    	$post->save();
    	return back();
    }

    protected function storeOrUpdate($request, $post = '')
    {
    	$response['failed'] = false;
    	$response['url'] = 'admin.post.index';
        $isFromUpdate = $post !== '';

        // create
            // select an existing one
                // no results:something went wrong... NOT POSSIBLE
                // more than 1 results:duplicates
                // 1 result:create a new
            // make a new location
                // no results:make a new one.
                // 1 result:something went wrong... NOT POSSIBLE
                // more than 1 results:something went wrong... NOT POSSIBLE
        // update
            // same as above but instead of creation just update

        $attributes = [
            'name' => $request['location']
        ];

        $location = Location::updateOrCreate($attributes);


            $attributes = [
                'name' => $request['speaker'],
                'location_id' => $location->id,
            ];

        $speaker = Speaker::updateOrCreate($attributes);        

    	// Update Or Create
        // dd($request->all());
    	if ($isFromUpdate) {
	    	$post->update([
	        	'title' => $request['title'],
	        	'speaker_id' => $speaker->id,
	        	'location_id' => $location->id,
	        	'date' => $request['date'],
	        	'video_src' => $request['video_src'],
	        	'content' => $request['content'],
                'mins_read' => $request['mins_read'],
                'meta' => $request['meta'],
	        	'user_id' => auth()->id(),
                'published_at' => $post->unpublish(),
	    	]);    	
            ProcessPostContent::dispatch($post)/*->delay(now()->addMinutes(1))*/; // use delay when you have a queue driver setup
    	} else {
            // dd('hit');
    		$post = Post::create([
	        	'title' => $request['title'],
	        	'speaker_id' => $speaker->id,
	        	'location_id' => $location->id,
	        	'date' => $request['date'],
	        	'video_src' => $request['video_src'],
	        	'content' => $request['content'],
                'mins_read' => $request['mins_read'],
                'meta' => $request['meta'],
	        	'user_id' => auth()->id(),
	        ]);
            ProcessPostContent::dispatch($post)/*->delay(now()->addMinutes(1))*/; // use delay when you have a queue driver setup
    	}

    	// Attache Tags
        $separateTags = $this->tagsSeparated($request['tags']);
        $post->tags()->detach(); // detaching all tags for this post first             
    	foreach ($separateTags as $key => $tagName) {
    		$tags = Tag::where('name', $tagName);
            // case if tag  doesn't exists
    		if ($tags->count() == 0) {
	    	// dd($tagName);
                $attributes = [
                    'name' => $tagName
                ];
                $tag = Tag::updateOrCreate($attributes); // whould only create perhaps

            // case if tag exists
	    	} else {
    	    	$tag = $tags->first();
            }
            $post->tags()->attach($tag->id);            
    	}

    	return $response;
    }

}
