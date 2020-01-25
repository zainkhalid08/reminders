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
