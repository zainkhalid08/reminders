<?php

namespace App\Traits;

use App\Surah;

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

    $contents = array();
    $startLength = strlen($start);
    $endLength = strlen($end);
    $startFrom = $contentStart = $contentEnd = 0;
    while (false !== ($contentStart = strpos($content, $start, $startFrom))) {
      $contentStart += $startLength;
      $contentEnd = strpos($content, $end, $contentStart);
      if (false === $contentEnd) {
        break;
      }
      $contents[] = substr($content, $contentStart, $contentEnd - $contentStart);
      $startFrom = $contentEnd + $endLength;
    }

    return $contents;
    
    
    // try 

    // $p1 = explode($start, $content);
    // $result = [];
    // for( $i=1; $i < count($p1); $i++ ){
    //     $p2 = explode($end, $p1[$i]);
    //     $result[] = $p2[0];
    // }
    // return $result;
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

  /**
   * Converts 2:44 to baqrah:44 
   *  
   * @param  string $reference eg. 2:44
   * @return string eg. baqrah:44
   */
  public function surahNumberToName($reference) : string
  {
    $delimiter = ':';
    $surahNumber = explode($delimiter, $reference); 
    $surah = Surah::findOrFail($surahNumber[0]);
    return $surah->name.$delimiter.$surahNumber[1]; 
  }  

}
