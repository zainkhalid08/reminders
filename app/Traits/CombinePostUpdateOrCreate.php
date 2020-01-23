<?php

namespace App\Traits;

use App\Location;
use App\Post;
use App\Speaker;
use App\Surah;
use App\Tag;


trait CombinePostUpdateOrCreate
{
  /**
   * Gives attributes for form needed for
   * creation and updation of post.
   *
   * @param array $data
   * @param App\Post $post
   * @return array
   */
  public function getFormSettingsForUpdateOrCreate() : array
  {
    $data = [];
    $post = request('post');
    if ($this->isFromStore()) { // is from create()
        $data['button'] = 'create';
        $data['action'] = route('admin.post.store');
        $data['method'] = 'POST';
    } elseif ($this->isFromUpdate()) { // is from edit()
        $data['button'] = 'update';
        $data['action'] = route('admin.post.update', $post->id);
        $data['method'] = 'PUT';
    }
    return $data;
  }

  /**
   * Tells that is request is from create()
   * of AdminPostController
   * 
   * @return boolean 
   */
  protected function isFromStore() : bool
  {
    $post = request('post');
    return is_null($post);
  }

  /**
   * Tells that is request is from update()
   * of AdminPostController
   * 
   * @return boolean 
   */
  protected function isFromUpdate() : bool
  {
    $post = request('post');
    return $post instanceof Post;
  }  

  /**
   * Gets all tags, speakers, locations and surahs
   * 
   * @return array
   */
  protected function getAllTagsSpeakersLocationsAndSurahs() : array
  {
    $data = [];
    $data['tags'] = Tag::all();
    $data['speakers'] = Speaker::all();
    $data['locations'] = Location::all();
    $data['surahs'] = Surah::all();
    return $data;
  }

  /**
   * Stores or updates a post
   * 
   * @param  App\Post $post
   * @return void
   */
  protected function updateOrCreate($post = '')
  {
    $request = request();

    /* Location */
    $location = Location::updateOrCreate(['name' => $request['location']]);

    /* Speaker */
    $speaker = Speaker::updateOrCreate(['name' => $request['speaker'], 'location_id' => $location->id]);        

    /* Update Or Create */
    if ($this->isFromUpdate()) {

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
      ]);     

    } elseif ($this->isFromStore()) {

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

    }

    /* Tags */
    $this->tagsUpdateOrCreate($post, $request);

  }

  /**
   * Update or create tags for this post.
   * 
   * @param  App\Post $post    
   * @param  \Illuminate\Http\Request $request 
   * @return void          
   */
  protected function tagsUpdateOrCreate($post, $request)
  {
    $post->tags()->detach(); // detaching all tags for this post first             

    $separateTags = $this->separateTags($request['tags']);
    foreach ($separateTags as $key => $tagName) {

      $tag = Tag::updateOrCreate(['name' => $tagName]);
      $post->tags()->attach($tag->id);            

    }
  }

}