<?php

namespace App;

use App\Post;
use App\Surah;
use App\Traits\StringExtractor;
use Illuminate\Database\Eloquent\Model;

class Ayah extends Model
{
	use StringExtractor;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'post_id', 'surah_number', 'ayah_number'];

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

    		if (static::isQuiteUnique($content)) {
    			static::createContentWithRefIfPresent($content, $post, $reference);
    		}

    	} else {
			static::createContentWithRefIfPresent($content, $post, $reference);
    	}
    }

    /**
     * Tells if this ayah is quite unique by
     * comparing with those present in db
     * 	
     * @param  string  $content 
     * @return boolean
     */
    protected static function isQuiteUnique($content) : bool
    {
    	foreach (static::all() as $ayah) {
			if (static::areQuiteSimilar($ayah->content, $content)) {
				return false;
			}
    	}
	    return true;
    }

    protected static function createContentWithRefIfPresent($content, $post, $reference = '')
    {
    	if ($reference !== '') {
	        $splitedReference = explode(':', $reference);
	        $surahNumber = static::surahNameToNumber($splitedReference[0]);
			static::create([
				'content' => $content,
				'surah_number' => $surahNumber,
				'ayah_number' => $splitedReference[1],
				'post_id' => $post->id,
			]);
    	} else {
			static::create([
				'content' => $content,
				'post_id' => $post->id,
			]);
    	}
    }

    public static function referenceAlreadyExists($surahNumber, $ayahNumber)
    {
    	return static::where('surah_number', $surahNumber)->where('ayah_number', $ayahNumber)->exists();
    }

    protected static function surahNameToNumber($name) : int
    {
    	return Surah::where('name', $name)->first()->id;
    }


    public static function areQuiteSimilar($first, $second, &$percentage = 0.0) : bool
    {
	    $similarilyPercentageThreshold = 60.0;
	    $first = strtoupper($first);
	    $second = strtoupper($second);
	    $similarityResults = similar_text($first, $second, $percentage);
	    return $percentage >= $similarilyPercentageThreshold ? true : false;
	}


}
