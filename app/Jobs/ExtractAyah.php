<?php

namespace App\Jobs;

use App\Ayah;
use App\Post;
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
    const AYAH_STARTING_DELIMITER_FOREVER = '<ayah>';

    /**
     * The ending delimiter of ayah 
     * used when creating a post.
     *
     * @var string
     */
    const AYAH_ENDING_DELIMITER_FOREVER = '</ayah>';

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
        $ayahTexts = $this->extractSubcontentFromBetween($content, static::AYAH_STARTING_DELIMITER_FOREVER, static::AYAH_ENDING_DELIMITER_FOREVER);
        info(json_encode($ayahTexts));
        foreach ($ayahTexts as $text) {
            // search for similarity in db
                // if there is :don't do anything
                // if there isn't : create in db.
            if (Ayah::count()) {
                $isNotPresentPerhaps = true;
                $i = 1;

                $ayahs = Ayah::all();
                foreach ($ayahs as $ayah) {

                    // dd($ayah->id);
                    echo $i++;
                    if ($this->areQuiteSimilar($ayah->content, $text, $percentage)) {
                        $isNotPresentPerhaps = false;
                        break;
                    }

                                                
                }
                
                if ($isNotPresentPerhaps) {

                    $attributes = [
                        'content' => $text,
                        'post_id' => $post->id,
                    ];

                    $this->createAyah($attributes);
                }
                        // dd($ayah->content, $text, $percentage);


            } else {

                $attributes = [
                    'content' => $text,
                    'post_id' => $post->id,
                ];

                $this->createAyah($attributes);

            }

        }
    }

    protected function createAyah($attributes)
    {
        $htmlTagFreeContent = $this->removeHtmlTags($attributes['content']);
        return  Ayah::create([
                    'content' => $htmlTagFreeContent,
                    'post_id' => $attributes['post_id'],
                ]);
    }

}
