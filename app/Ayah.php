<?php

namespace App;

use App\Contracts\SimilarityCheckable;
use App\Helpers\SimilarityChecker;
use App\Post;
use App\Surah;
use App\Traits\StringExtractor;
use Illuminate\Database\Eloquent\Model;

class Ayah extends Model implements SimilarityCheckable
{
	use StringExtractor;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'raw_content', 'post_id', 'surah_number', 'ayah_number'];

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
     * Creates ayah with/without ref
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
    			static::createAyah($content, $post, $reference);
    		}

    	} else {
			static::createAyah($content, $post, $reference);
    	}
    }

    /**
     * Creates ayah with/without reference
     * 
     * @param  string $content   
     * @param  App\Post $post      
     * @param  string $reference
     * @return void            
     */
    protected static function createAyah($content, $post, $reference = '') : void
    {
    	if (static::referenceIsPresent($reference)) {
	        $splitedReference = explode(':', $reference);
	        $surahNumber = Surah::nameToNumber($splitedReference[0]);
			static::create([
				'content' => $content,
                'raw_content' => (new static)->removeHtmlChars($content),
				'surah_number' => $surahNumber,
				'ayah_number' => $splitedReference[1],
				'post_id' => $post->id,
			]);
    	} else {
			static::create([
				'content' => $content,
                'raw_content' => (new static)->removeHtmlChars($content),
				'post_id' => $post->id,
			]);
    	}
    }

    /**
     * Tells if this reference already exists
     * 
     * @param  int $surahNumber 
     * @param  int $ayahNumber  
     * @return boolean              
     */
    public static function referenceAlreadyExists($surahNumber, $ayahNumber) : bool
    {
    	return static::where('surah_number', $surahNumber)->where('ayah_number', $ayahNumber)->exists();
    }

    protected static function referenceIsPresent($reference) : bool
    {
    	return $reference !== '';
    }


}
