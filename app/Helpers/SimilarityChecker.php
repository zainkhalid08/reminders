<?php

namespace App\Helpers;

use App\Contracts\SimilarityCheckable;

/**
 * 
 */
class SimilarityChecker 
{
	
    /**
     * The entity that implements
     * App\Contracts\SimilarityCheckable
     *
     * @var implements App\Contracts\SimilarityCheckable
     */
	protected $checkable;

	function __construct(SimilarityCheckable $checkable)
	{
		$this->checkable = $checkable;
	}

    /**
     * Tells if this checkable is quite unique by
     * comparing with those present in db
     *
     * NOTE: $haystack MUST BE A COLLECTION OF CHECKABLES
     * 	
     * @param  string  $content 
     * @param  Illuminate\Support\Collection $content 
     * @return boolean
     */
    public function isQuiteUnique($content) : bool
    {
    	$checkable = get_class($this->checkable);
    	foreach ($checkable::all() as $checkable) {
			if (static::areQuiteSimilar($checkable->content(), $content, $checkable->threshold())) {
				return false;
			}
    	}
	    return true;
    }

    /**
     * Tells if two contents are quite similar,
     * quite similar means are about x percent
     * similar.
     * 
     * @param  string $first
     * @param  string $second
     * @param  float $threshold
     * @param  float  &$percentage
     * @return boolean	
     */
    public static function areQuiteSimilar($first, $second, $threshold = 60.0, &$percentage = 0.0) : bool
    {
	    $similarilyPercentageThreshold = $threshold;
	    $first = strtoupper($first);
	    $second = strtoupper($second);
	    $similarityResults = similar_text($first, $second, $percentage);
	    return $percentage >= $similarilyPercentageThreshold ? true : false;
	}


}