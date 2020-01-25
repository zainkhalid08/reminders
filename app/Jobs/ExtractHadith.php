<?php

namespace App\Jobs;

use App\Hadith;
use App\Post;
use App\Traits\StringExtractor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExtractHadith implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, StringExtractor;

    protected $post;

    /**
     * The starting delimiter of hadith 
     * used when creating a post.
     *
     * @var string
     */
    const HADITH_STARTING_DELIMITER_FOREVER = '"hadith>';

    /**
     * The ending delimiter of hadith 
     * used when creating a post.
     *
     * @var string
     */
    const HADITH_ENDING_DELIMITER_FOREVER = '</hadith>';

    /**
     * The starting delimiter of hadith reference 
     * used when creating a post.
     *
     * @var string
     */
    const HADITH_REF_STARTING_DELIMITER_FOREVER = 'hadith="';

    /**
     * The ending delimiter of hadith 
     * used when creating a post.
     *
     * @var string
     */
    const HADITH_REF_ENDING_DELIMITER_FOREVER = '"hadith>';

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
     */
    public function handle()
    {
        $post = $this->post;

        $content = $post->content;

        $hadithTexts = $this->getAllHadithsContents($content);

        $hadithRefs = $this->getAllHadithRefsContents($content);
        
        if ($this->contentIsNotEmpty($hadithTexts)) {
            foreach ($hadithTexts as $hadithNumber => $text) {
                if ($this->keyDoesntExist($hadithNumber, $hadithRefs) || $this->refIsInvalid($hadithRefs[$hadithNumber])) { 
                    Hadith::createBasedOnUniqueness($text, $post); // creating without ref
                } else {
                    Hadith::createBasedOnUniqueness($text, $post, $hadithRefs[$hadithNumber]);
                }
            }
        }
    }

    /**
     * Gets all hadiths with its contents
     * 
     * @param  string $content content
     * @return array
     *
     * @example   [0 => 'first hadith content', 1 => 'second hadith content']
     */
    protected function getAllHadithsContents($content) : array
    {
        $allhadiths = $this->extractContentsFromBetween($content, static::HADITH_STARTING_DELIMITER_FOREVER, static::HADITH_ENDING_DELIMITER_FOREVER);
        return array_filter($allhadiths); 
    }    

    /**
     * Gets all Hadiths reference's contents
     * 
     * @param  string $content content
     * @return string
     *
     * @example   [0 => 'first Hadith ref content', 1 => 'second Hadith ref content']
     *
     * NOTE: for an Hadiths without ref it'll be ''
     */
    protected function getAllHadithRefsContents($content) : array
    {
        return $this->extractContentsFromBetween($content, static::HADITH_REF_STARTING_DELIMITER_FOREVER, static::HADITH_REF_ENDING_DELIMITER_FOREVER); 
    }   

    /**
     * Tells if a reference is invalid
     * if it is just numeric we'll
     * call it an invalid one.
     *     
     * @param  string
     * @return boolean
     */
    protected function refIsInvalid($reference) : bool
    {
        return is_numeric($reference) ? true : false;
    }



}
