<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Location;
use App\Post;
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
    public function index()
    {
    	$posts = Post::latest()->get();
    	// dd($posts->count());
        return view('admin.post.index', ['posts' => $posts]);
    }

    /**
     * Shows the admin's dashboard
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = ''; $speakers = ''; $locations = ''; $createOrUpdate = 'create'; $formAction = route('admin.post.store'); $formMethod = 'POST'; 

        $this->getAllTagsSpeakersAndLocations($tags, $speakers, $locations);

        return view('admin.post.create_or_update', compact('tags', 'speakers', 'locations', 'createOrUpdate', 'formAction', 'formMethod'));
    }

    /**
     * @param \App\Http\Requests\PostStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
    	// dd($request->all());
    	// dd('passed');

    	$speaker = Speaker::where('name', $request['speaker']);
    	if ($speaker->count() == 0) {
    		abort(404);
    	} elseif ($speaker->count() !== 1) {
    		return back()->withErrors(['speaker' => 'Duplicate speakers']);
    	}
    	$speaker = $speaker->first();

    	$location = Location::where('name', $request['location']);
    	if ($location->count() == 0) {
    		// abort(404);
    	} elseif ($location->count() !== 1) {
    		return back()->withErrors(['location' => 'Duplicate locations']);
    	}
    	$location = $location->first();


        $post = Post::create([
        	'title' => $request['title'],
        	'speaker_id' => $speaker->id,
        	'location_id' => $location->id,
        	'date' => $request['date'],
        	'video_src' => $request['video_src'],
        	'content' => $request['content'],
        	'user_id' => auth()->id(),
        ]);

        // dd($post);
        $separateTags = $request->separateTags($request['tags']);
    	foreach ($separateTags as $key => $tagName) {
    		$tag = Tag::where('name', $tagName);
    		if ($tag->count() == 0) {
	    	// dd($tagName);
	    		abort(404);
	    	} elseif ($tag->count() !== 1) {
	    		return back()->withErrors(['tag' => 'Duplicate tags']);
	    	}
	    	$tag = $tag->first();
			$post->tags()->attach($tag->id);    		
    	}


        // event(new NewPost($post));

        $request->session()->flash('post.title', $post->title);

        return redirect()->route('admin.post.index');
    }

    public function edit(Request $request, Post $post)
    {
        $tags = ''; $speakers = ''; $locations = ''; $createOrUpdate = 'update'; $formAction = route('admin.post.update', $post->id); $formMethod = 'PUT';

        $this->getAllTagsSpeakersAndLocations($tags, $speakers, $locations);

        return view('admin.post.create_or_update', compact('tags', 'speakers', 'locations', 'createOrUpdate', 'formAction', 'formMethod', 'post'));
    }

    public function update(PostRequest $request, Post $post)
    {
    	$speaker = Speaker::where('name', $request['speaker']);
    	if ($speaker->count() == 0) {
    		abort(404);
    	} elseif ($speaker->count() !== 1) {
    		return back()->withErrors(['speaker' => 'Duplicate speakers']);
    	}
    	$speaker = $speaker->first();

    	$location = Location::where('name', $request['location']);
    	if ($location->count() == 0) {
    		// abort(404);
    	} elseif ($location->count() !== 1) {
    		return back()->withErrors(['location' => 'Duplicate locations']);
    	}
    	$location = $location->first();

    	$post->update([
        	'title' => $request['title'],
        	'speaker_id' => $speaker->id,
        	'location_id' => $location->id,
        	'date' => $request['date'],
        	'video_src' => $request['video_src'],
        	'content' => $request['content'],
        	'user_id' => auth()->id(),
    	]);

        // dd($post);
        $separateTags = $request->separateTags($request['tags']);
    	foreach ($separateTags as $key => $tagName) {
    		$tag = Tag::where('name', $tagName);
    		if ($tag->count() == 0) {
	    	// dd($tagName);
	    		abort(404);
	    	} elseif ($tag->count() !== 1) {
	    		return back()->withErrors(['tag' => 'Duplicate tags']);
	    	}
	    	$tag = $tag->first();
			$post->tags()->attach($tag->id);    		
    	}


        // event(new NewPost($post));

        $request->session()->flash('post.title', $post->title);

        return redirect()->route('admin.post.index');

    }

    protected function getAllTagsSpeakersAndLocations(&$tags, &$speakers, &$locations)
    {
        $tags = Tag::all();
        $speakers = Speaker::all();
        $locations = Location::all();
    }

}
