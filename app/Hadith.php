<?php

namespace App;

use App\Contracts\SimilarityCheckable;
use App\Helpers\SimilarityChecker;
use Illuminate\Database\Eloquent\Model;

class Hadith extends Model implements SimilarityCheckable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'post_id', 'reference'];

    /**
     * Part of the contract App\Contracts\SimilarityCheckable
     * 
     * @return string 
     */
    public function content() : string
    {
    	return $this->content;
    }

    /**
     * Part of the contract App\Contracts\SimilarityCheckable
     * 
     * @return float 
     */
    public function threshold() : float
    {
    	return 60.0;
    }
	
    /**
     * Creates hadith with/without ref
     * if it is quite unique
     * 
     * @param  string $content   
     * @param  string $reference 
     * @return void            
     */
    public static function createBasedOnUniqueness(string $content, Post $post, $reference = '')
    {
    	if (static::count()) {

    		$similarityChecker = new SimilarityChecker(new static);

    		if ($similarityChecker->isQuiteUnique($content)) {
    			static::createHadith($content, $post, $reference);
    		}

    	} else {
			static::createHadith($content, $post, $reference);
    	}
    }

    /**
     * Creates hadith with/without reference
     * 
     * @param  string $content   
     * @param  App\Post $post      
     * @param  string $reference
     * @return void            
     */
    protected static function createHadith($content, $post, $reference = '') : void
    {
    	$reference = static::referenceIsPresent($reference) ? $reference : null;
		static::create([
            'content' => $content,
            'post_id' => $post->id,
            'reference' => $reference,
        ]);
    }

    protected static function referenceIsPresent($reference) : bool
    {
    	return $reference !== '';
    }

}
