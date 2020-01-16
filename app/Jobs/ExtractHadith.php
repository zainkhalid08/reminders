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
        $hadithTexts = $this->extractSubcontentFromBetween($content, static::HADITH_STARTING_DELIMITER_FOREVER, static::HADITH_ENDING_DELIMITER_FOREVER);
        // dd($hadithTexts);
        $hadithRefs = $this->extractSubcontentFromBetween($content, static::HADITH_REF_STARTING_DELIMITER_FOREVER, static::HADITH_REF_ENDING_DELIMITER_FOREVER);
        // dd($hadithRefs);

            // search for similarity in db
                // if there is :don't do anything
                // if there isn't : create in db.
        foreach ($hadithTexts as $key => $text) {
            
            if (Hadith::count()) {
                $isNotPresentPerhaps = true;

                $hadiths = Hadith::all();
                foreach ($hadiths as $hadith) {

                    // dd($hadith->id);
                    if ($this->areQuiteSimilar($hadith->content, $text, $percentage)) {
                        $isNotPresentPerhaps = false;
                        break;
                    }

                                                
                }
                
                if ($isNotPresentPerhaps) {

                    $this->createHadith($text, $post, $hadithRefs[$key]);
                }


            } else {

                $this->createHadith($text, $post, $hadithRefs[$key]);

            }

        }
    }

    /**
     * Creates Hadith
     * 
     * @param  string $text content
     * @param  \App\Post $post 
     * @param  string $reference
     * 
     * @return \App\Hadith
     */
    protected function createHadith($text, $post, $reference)
    {
        $htmlTagFreeContent = $this->removeHtmlTags($text);

        return  Hadith::create([
                    'content' => $htmlTagFreeContent,
                    'post_id' => $post->id,
                    'reference' => $reference,
                ]);
    }

}
