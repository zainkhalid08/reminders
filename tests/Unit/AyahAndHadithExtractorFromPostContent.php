<?php

namespace Tests\Unit;

use App\Jobs\ExtractAyah;
// use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AyahAndHadithExtractorFromPostContent extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testWhenNoAyahIsPresent()
    {
    	$content = '';

    	$post = factory(\App\Post::class)->create();
    	dd($post);

    	// $job = new ExtractAyah($post);
    	// dd($job);
        $this->assertTrue(true);
    }
}
