<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Jobs\ProcessPostContent;
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
        $tags = ''; $speakers = ''; $locations = ''; $createOrUpdate = 'update'; $formAction = route('admin.post.update', $post->id); $formMethod = 'PUT';

        $this->getAllTagsSpeakersAndLocations($tags, $speakers, $locations);

        return view('admin.post.create_or_update', compact('tags', 'speakers', 'locations', 'createOrUpdate', 'formAction', 'formMethod', 'post'));
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

    protected function getAllTagsSpeakersAndLocations(&$tags, &$speakers, &$locations)
    {
        $tags = Tag::all();
        $speakers = Speaker::all();
        $locations = Location::all();
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

        // echo "test speaker";
        // dd($speaker);
            
    	// Location
    	// $location = Location::where('name', $request['location']);
     //    if ($isFromUpdate) {
     //        // case no results
     //        if ($location->count() == 1) {
     //            $location = $location->first();
     //            $location->update([
     //                'name' => $request['location'],
     //            ]);  

     //        // case more than 0 results or less than 0
     //        } elseif ($location->count() == 0) {
     //            $location = Location::create([
     //                'name' => $request['location'],
     //            ]);
     //        } else {
     //            $response['failed'] = true;
     //            $response['entity'] = 'location';
     //            return $response;
     //        }           

     //    } else {

     //        // case no results
     //        if ($location->count() == 0) {
     //            $location = Location::create([
     //                'name' => $request['location'],
     //            ]);

     //        // case more than 0 results or less than 0
     //        } elseif ($location->count() == 1) {
     //            $location = $location->first();
     //            // dd($location);
     //        } else { // duplicate or < 0
     //            $response['failed'] = true;
     //            $response['entity'] = 'location';
     //            return $response;
     //        }
     //    }

        // dd($location);
    	// Speaker
    	// $speaker = Speaker::where('name', $request['speaker']);
    	// if ($isFromUpdate) {
     //        // case no results
     //        if ($speaker->count() == 1) {
     //            // dd($speaker);
     //            $speaker = $speaker->first();
     //            $speaker->update([
     //                'name' => $request['speaker'],
     //                'location_id' => $location->id,
     //            ]);  

     //        // case more than 0 results or less than 0
     //        } elseif ($speaker->count() == 0) {
     //            $speaker = Speaker::create([
     //                'name' => $request['speaker'],
     //                'location_id' => $location->id,
     //            ]);
     //        } else {
     //            $response['failed'] = true;
     //            $response['entity'] = 'speaker';
     //        }           

     //    } else {

     //        // dd($location);
     //        // case no results
     //        if ($speaker->count() == 0) {
     //            $speaker = Speaker::create([
     //                'name' => $request['speaker'],
     //                'location_id' => $location->id,
     //            ]);
     //            // dd($location);

     //            // dd($speaker);
     //        } elseif ($speaker->count() == 1) {
     //            // dd($speaker);
     //            $speaker = $speaker->first();
     //        } else { // duplicate or < 0
     //            $response['failed'] = true;
     //            $response['entity'] = 'speaker';
     //            return $response;
     //        }
     //    }

    	// Update Or Create
    	if ($isFromUpdate) {
	    	$post->update([
	        	'title' => $request['title'],
	        	'speaker_id' => $speaker->id,
	        	'location_id' => $location->id,
	        	'date' => $request['date'],
	        	'video_src' => $request['video_src'],
	        	'content' => $request['content'],
	        	'user_id' => auth()->id(),
	    	]);    	
            ProcessPostContent::dispatch($post)/*->delay(now()->addMinutes(1))*/;
    	} else {
            // dd('hit');
    		$post = Post::create([
	        	'title' => $request['title'],
	        	'speaker_id' => $speaker->id,
	        	'location_id' => $location->id,
	        	'date' => $request['date'],
	        	'video_src' => $request['video_src'],
	        	'content' => $request['content'],
	        	'user_id' => auth()->id(),
	        ]);
            ProcessPostContent::dispatch($post)->delay(now()->addMinutes(1));
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
