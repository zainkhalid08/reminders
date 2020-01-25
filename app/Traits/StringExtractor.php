<?php

namespace App\Traits;

use App\Surah;

// use Illuminate\Support\Carbon;

trait StringExtractor
{
   /**
   * Combined tags of this post as a string
   *
   * @param string $content
   * @param string $start
   * @param string $end
   * @return array 
   *
   * @example [0 => 'content b/w first occurance', 1 => 'content b/w second occurance']
   *
   * NOTE: For the case if occurance($start and $end) is found but no content
   * is present in between then '' for that occurance like  [0 => '']   
   */
  public function extractContentsFromBetween($content, $start, $end) : array
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
   * Tells if content is not empty
   * 
   * @param  array $content 
   * @return boolean
   */
  protected function contentIsNotEmpty(array $arrayOfStrings) : bool
  {
      $arrayOfStrings = array_filter($arrayOfStrings);
      return ! empty($arrayOfStrings);
  }   
  
  protected function keyDoesntExist($key, $array) : bool
  {
      return ! key_exists($key, $array);
  }


}
