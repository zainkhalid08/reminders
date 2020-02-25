<?php

namespace App\Traits;

use App\Post;


trait GivesRouteBySubmissionType
{
  /**
   * Returns an appropriate redirect back route
   *
   * @param \App\Http\Requests\PostStoreRequest $request Didn't type hint to make it flexible
   * @param App\Post $post
   * @return string
   */
  public function getRouteBySubmissionType($request, Post $post) : string
  {
    $submissionType = $request['redirects_to'];

    if ($submissionType == 'admin_all_posts') { // 'DONE' is pressed
      $route = route('admin.post.index');
    } elseif ($submissionType == 'post_edit') { // 'SAVE' is pressed
        $route = route('admin.post.edit', $post->id);
    } else {
      $route = route('admin.post.index');
    }
    return $route;
  }

}