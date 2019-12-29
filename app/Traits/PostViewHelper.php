<?php

namespace App\Traits;

// use Illuminate\Support\Carbon;

trait PostViewHelper
{
    /**
     * Combined tags of this post as a string
     *
     * @param \App\Post
     * @return string $tagsCombined
     * 
     * @example $post->tagsCombined()
     */
    public function tagsCombined()
    {
       $tagsCombined = '';
       $tags = $this->tags;
       $i = 1;
       foreach ($tags as $tag) {
            $ending = ($i++ == count($tags) ? '' : ', ');
            $tagsCombined .= $tag->name.$ending;
        } 
        return $tagsCombined;
    }

    public function readableDate()
    {
      return $this->date->format('d, M Y');
    }

    public function isFitToBeNew()
    {
      $allowedDaysToBeNew = 3;
      return $this->date->diffInDays(now()) <= $allowedDaysToBeNew;
    }

    /**
     * Returns well crafted title for a post to display in a list of posts
     * 
     * @return string
     */
    public function title()
    {
      $logo = '';
      if ($this->isFrom('Masjid Al Haram')) {
        // $logo .= '🕋 ';
      }
      $newBadge = '';
      if ($this->isFitToBeNew()) {
        $newBadge = ' <span class="badge badge-primary">New</span>';
      }
      return $logo.$this->title.$newBadge;
    }

    /**
     * Tells if the post is from a certain location 
     * 
     * @param  string 
     * @return boolean
     */
    public function isFrom($locationName) : bool
    {
      return $this->location->name == $locationName;
    }
}
