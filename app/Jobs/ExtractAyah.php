<?php

namespace App\Jobs;

use App\Ayah;
use App\Post;
use App\Surah;
use App\Traits\StringExtractor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExtractAyah implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, StringExtractor;

    protected $post;

    /**
     * The starting delimiter of ayah 
     * used when creating a post.
     *
     * @var string
     */
    const AYAH_STARTING_DELIMITER_FOREVER = '"ayah>';

    /**
     * The ending delimiter of ayah 
     * used when creating a post.
     *
     * @var string
     */
    const AYAH_ENDING_DELIMITER_FOREVER = '</ayah>';

    /**
     * The starting delimiter of AYAH reference 
     * used when creating a post.
     *
     * @var string
     */
    const AYAH_REF_STARTING_DELIMITER_FOREVER = 'ayah="';

    /**
     * The ending delimiter of AYAH 
     * used when creating a post.
     *
     * @var string
     */
    const AYAH_REF_ENDING_DELIMITER_FOREVER = '"ayah>';

    /**
     * 
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     * 
     * save content with ref(if it is available & valid)
     */
    public function handle()
    {
        $post = $this->post;

        $content = $post->content;

        $ayahTexts = $this->getAllAyahsContents($content);

        $ayahRefs = $this->getAllAyahRefsContents($content);
        // dd($ayahRefs);
        
        if ($this->contentIsNotEmpty($ayahTexts)) {
            foreach ($ayahTexts as $ayahNumber => $text) {
                if ($this->keyDoesntExist($ayahNumber, $ayahRefs) || $this->refIsInvalid($ayahRefs[$ayahNumber])) { 
                    Ayah::createBasedOnUniqueness($text, $post); // creating without ref
                } else {
                    Ayah::createBasedOnUniqueness($text, $post, $ayahRefs[$ayahNumber]);
                }
            }
        }
    }

    /**
     * Gets all ayahs with its contents
     * 
     * @param  string $content content
     * @return array
     *
     * @example   [0 => 'first ayah content', 1 => 'second ayah content']
     */
    protected function getAllAyahsContents($content) : array
    {
        $allAyahs = $this->extractContentsFromBetween($content, static::AYAH_STARTING_DELIMITER_FOREVER, static::AYAH_ENDING_DELIMITER_FOREVER);
        return array_filter($allAyahs); 
    }    

    /**
     * Gets all ayahs reference's contents
     * 
     * @param  string $content content
     * @return string
     *
     * @example   [0 => 'first ayah ref content', 1 => 'second ayah ref content']
     *
     * NOTE: for an ayahs without ref it'll be ''
     */
    protected function getAllAyahRefsContents($content) : array
    {
        return $this->extractContentsFromBetween($content, static::AYAH_REF_STARTING_DELIMITER_FOREVER, static::AYAH_REF_ENDING_DELIMITER_FOREVER); 
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

    protected function keyDoesntExist($key, $array)
    {
        return ! key_exists($key, $array);
    }



    /**
     * Tells if a reference is invalid
     *     
     * @param  string
     * @return boolean
     *
     * NOTE: IF ANYTHING(EITHER SURAH NAME OR AYAH) IS MISSING, WE'LL CALL IT A MISTAKE HENCE IS INVALID
     *
     * CODITIONS FOR INVALIDITY
     * 1. if both surah name and ayah number are not present
     * 2. if surah name ! exists
     * 3. if ayah number is > total ayahs of this surah
     * 4. surah ref is already present
     */
    protected function refIsInvalid($reference) : bool
    {
        $splitedReference = explode(':', $reference);
        $nonEmptySplitedReference = array_filter($splitedReference);

        if (count($nonEmptySplitedReference) !== 2) {
            return true;
        }

        $surahName = $nonEmptySplitedReference[0];
        $ayahNumber = $nonEmptySplitedReference[1];

        $surah = Surah::where('name', $surahName)->first();

        if ( is_null($surah) || $ayahNumber > $surah->ayahs ) {
            return true;
        }

        if (Ayah::referenceAlreadyExists($surah->id, $ayahNumber)) {
            return true;
        }

        return false; 
    }

}
