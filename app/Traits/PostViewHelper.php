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
}
