<?php

namespace App\Traits;

use Illuminate\Support\Str;

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
      return $this->created_at->diffInDays(now()) <= $allowedDaysToBeNew;
    }

    /**
     * Returns well crafted title for a post to display in a list of posts
     * 
     * @return string
     */
    public function title()
    {
      $logo = '';
      // if ($this->isFrom('Masjid Al Haram')) {
      //   // $logo .= '🕋 ';
      // }
      $newBadge = '';
      if ($this->isFitToBeNew()) {
        $newBadge = ' <span class="badge badge-primary">New</span>';
      }
      return $logo.$this->title.$newBadge;
    }

    /**
     * For <title></title> as A Great Post
     * 
     * @return string
     */
    public function titleHtmlTag()
    {
      return ucwords(strtolower($this->title));
    }


    /**
     * Returns well crafted subheading having imp info of the post
     * eg speaker, location, mins read etc
     * 
     * @return string
     */
    public function meta()
    {
      $separator = ' | ';

      $minsRead = $this->mins_read ? $this->mins_read.' mins read <span title="approximation">apx.</span>' : '';
      
      $arrangement = [
        $minsRead,
        $this->speaker->name,
        $this->readableDate(),
        $this->location->name,
      ];

      return implode($separator, $arrangement);
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

    /**
     * Returns the url for post.show in a seoed maner
     * 
     * @param  string route name
     * @return string
     */
    public function seoRoute($name) : string
    {
      $delimiter = '-';
      $title = Str::slug($this->title, $delimiter);
      $location = Str::slug($this->location->name, $delimiter);

      if ($name == 'post.show') {
        return route('post.show', ['post' => $this->id, 'title' => $title, 'location' => $location]);
      } 

    }

}
