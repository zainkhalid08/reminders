<?php

namespace App\Traits;

use App\Location;
use App\Post;
use App\Speaker;
use App\Surah;
use App\Tag;


trait CombinePostCreateAndUpdate
{
  /**
   * Gives attributes for form needed for
   * creation and updation of post.
   *
   * @param array $data
   * @param App\Post $post
   * @return array
   */
  public function getFormSettingsForCreateOrUpdate() : array
  {
    $data = [];
    $post = request('post');
    if (is_null($post)) { // is from create()
        $data['button'] = 'create';
        $data['action'] = route('admin.post.store');
        $data['method'] = 'POST';
    } elseif ($post instanceof Post) { // is from edit()
        $data['button'] = 'update';
        $data['action'] = route('admin.post.update', $post->id);
        $data['method'] = 'PUT';
    }
    return $data;
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


}