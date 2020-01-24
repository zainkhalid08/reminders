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
     */
    public function handle()
    {
        $post = $this->post;

        $content = $post->content;
        // dd($content);
        // $ayahTexts = $this->extractSubcontentFromBetween($content, static::AYAH_STARTING_DELIMITER_FOREVER, static::AYAH_ENDING_DELIMITER_FOREVER);
        $ayahTexts = $this->getAyahContent($content);
        // dd($ayahTexts);

        // $ayahRefs = $this->extractSubcontentFromBetween($content, static::AYAH_REF_STARTING_DELIMITER_FOREVER, static::AYAH_REF_ENDING_DELIMITER_FOREVER);
        $ayahRefs = $this->getAyahRefContent($content);
        // dd($ayahRefs);

        // if no contetn
            // die
        // if content
            // no ref
                // save content
            // ref
                // save content and ref
        
        if ($this->contentIsEmpty($ayahTexts)) {
            return;
        } else {
            if ($this->contentIsEmpty($ayahRefs)) {
                // save content
                // dd('hit');
                $this->saveContentOnly($ayahTexts, $post);
            } else {
                // save content and ref
                $this->saveContentAndRef($ayahTexts, $post, $ayahRefs);
            }
        }


    }

    /**
     * Creates Ayah
     * 
     * @param  string $text content
     * @param  \App\Post $post 
     * @param  string $reference
     * 
     * @return \App\Ayah
     */
    protected function createAyah($text, $post, $reference = '')
    {

        $reference = explode(':', $reference);
        // dd($reference);

        $htmlTagFreeContent = $this->removeHtmlTags($text);

        if ( count($reference) === 2 ) { // COMPLETE ref is present
            $surahName = $reference[0];
            $ayahNumber = $reference[1];

            $surah = Surah::where('name', $surahName)->first();

            if (is_null($surah)) {
                $msg = 'used surah number instead of a name';
                info('used surah number instead of a name');
                die($msg);
            }
            // dd($surah);

            $exists = Ayah::where('surah', $surah->id)->where('ayah', $ayahNumber)->exists();

            if (! $exists) {
                return  Ayah::create([
                            'content' => $htmlTagFreeContent,
                            'post_id' => $post->id,
                            'surah' => $surah->id,
                            'ayah' => $ayahNumber,
                        ]);
            }
        } else {
            dd('h');
            Ayah::create([
                'content' => $htmlTagFreeContent,
                'post_id' => $post->id,
            ]);            
        }

    }

    /**
     * Gets content of ayah
     * 
     * @param  string $content content
     * @return string
     */
    protected function getAyahContent($content)
    {
        return $this->extractSubcontentFromBetween($content, static::AYAH_STARTING_DELIMITER_FOREVER, static::AYAH_ENDING_DELIMITER_FOREVER);
    }    

    /**
     * Gets content of ayah ayah reference
     * 
     * @param  string $content content
     * @return string
     */
    protected function getAyahRefContent($content)
    {
        return $this->extractSubcontentFromBetween($content, static::AYAH_REF_STARTING_DELIMITER_FOREVER, static::AYAH_REF_ENDING_DELIMITER_FOREVER);
    }    

    /**
     * Tells if content is empty
     * 
     * @param  string $content 
     * @return boolean
     */
    protected function contentIsEmpty($content) : bool
    {
        $content = array_filter($content);
        return empty($content);
    }   

    protected function saveContentOnly(array $ayahTexts, $post)
    {
        foreach ($ayahTexts as $ayahNumber => $text) {
            // search for similarity in db
                // if there is :don't do anything
                // if there isn't : create in db.
            $isNotPresentPerhaps = true;
            if (Ayah::count()) {

                $ayahs = Ayah::all();
                foreach ($ayahs as $ayah) {

                    // dd($ayah->id);
                    if ($this->areQuiteSimilar($ayah->content, $text, $percentage)) {
                        $isNotPresentPerhaps = false;
                        break;
                    }

                                                
                }
                
                if ($isNotPresentPerhaps) {

                    $this->createAyah($text, $post);
                }
                // dd('h');

            } else {
                // dd('hit');


                // dd($ayahRefs);
                $this->createAyah($text, $post);

            }

        }
    } 

    protected function saveContentAndRef(array $ayahTexts, $post, array $ayahRefs)
    {
        foreach ($ayahTexts as $ayahNumber => $text) {
            // search for similarity in db
                // if there is :don't do anything
                // if there isn't : create in db.
            $isNotPresentPerhaps = true;
            if (Ayah::count()) {

                $ayahs = Ayah::all();
                foreach ($ayahs as $ayah) {

                    // dd($ayah->id);
                    if ($this->areQuiteSimilar($ayah->content, $text, $percentage)) {
                        $isNotPresentPerhaps = false;
                        break;
                    }

                                                
                }
                
                if ($isNotPresentPerhaps) {

                    $this->createAyah($text, $post, $ayahRefs[$ayahNumber]);
                }
                // dd('h');

            } else {

                // dd($ayahRefs);
                $this->createAyah($text, $post, $ayahRefs[$ayahNumber]);

            }

        }
    } 

}
