<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Jobs\ProcessPostContent;
use App\Location;
use App\Post;
use App\Speaker;
use App\Surah;
use App\Tag;
use Illuminate\Http\Request;

class AdminPostController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Shows the admin's dashboard
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$posts = Post::latest('updated_at')->get();
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
        $tags = ''; $speakers = ''; $locations = ''; $createOrUpdate = 'create'; $formAction = route('admin.post.store'); $formMethod = 'POST'; $surahs = ''; 

        $this->getAllTagsSpeakersAndLocations($tags, $speakers, $locations, $surahs);

        return view('admin.post.create_or_update', compact('tags', 'speakers', 'locations', 'createOrUpdate', 'formAction', 'formMethod', 'surahs'));
    }

    /**
     * @param \App\Http\Requests\PostStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
    	// dd($request->all());

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
        $tags = ''; $speakers = ''; $locations = ''; $createOrUpdate = 'update'; $formAction = route('admin.post.update', $post->id); $formMethod = 'PUT'; $surahs = '';

        $this->getAllTagsSpeakersAndLocations($tags, $speakers, $locations, $surahs);

        return view('admin.post.create_or_update', compact('tags', 'speakers', 'locations', 'createOrUpdate', 'formAction', 'formMethod', 'post', 'surahs'));
    }

    public function update(PostRequest $request, Post $post)
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

    protected function getAllTagsSpeakersAndLocations(&$tags, &$speakers, &$locations, &$surahs)
    {
        $tags = Tag::all();
        $speakers = Speaker::all();
        $locations = Location::all();
        $surahs = Surah::all();
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
        $separateTags = $request->separateTags($request['tags']);
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
