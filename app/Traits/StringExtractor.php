<?php

namespace App\Traits;

// use Illuminate\Support\Carbon;

trait StringExtractor
{
   /**
   * Combined tags of this post as a string
   *
   * @param \App\Post
   * @return string $tagsCombined
   * 
   * @example $post->tagsCombined()
   */
  public function extractSubcontentFromBetween($content, $start, $end)
  {
    $p1 = explode($start, $content);
    $result = [];
    for( $i=1; $i < count($p1); $i++ ){
        $p2 = explode($end, $p1[$i]);
        $result[] = $p2[0];
    }
    return $result;
  }

  /**
   * Tells if two strings are similar
   * 
   * @param  string $first              
   * @param  string $second             
   * @param  float  $percentage  minimum similarity requirement
   * 
   * @return boolean
   */
  public function areQuiteSimilar($first, $second, &$percentage = 0.0) : bool
  {
    $similarilyPercentageThreshold = 60.0;
    $first = strtoupper($first);
    $second = strtoupper($second);
    $similarityResults = similar_text($first, $second, $percentage);
    return $percentage >= $similarilyPercentageThreshold ? true : false;
  }

  /**
   * Removes only html tags not special chars like &nbsp;
   *  
   * @param  string $content
   * @return string          
   */
  public function removeHtmlTags($content) : string
  {
    return strip_tags($content);
  }

}
