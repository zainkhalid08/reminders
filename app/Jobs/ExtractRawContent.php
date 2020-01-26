<?php

namespace App\Jobs;

use App\Post;
use App\Traits\StringExtractor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * MAINTAINING HTML TAG FREE CONENT FOR GOOD SEARCH
 */
class ExtractRawContent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, StringExtractor;

    protected $post;

    /**
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
        $rawContent = $this->removeHtmlChars($post->content);
        $post->raw_content = $rawContent;
        $post->save();
    }
}
