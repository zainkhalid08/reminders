<?php

namespace Tests\Feature\Http\Controllers;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\Feature\Http\Requests\PostTrait;
use Tests\TestCase;

trait PostControllerShowMethodTest 
{

    public function test_if_post_is_published_then_should_see_post()
    {
        $post = factory(Post::class)->create(['published_at' => now()]);
        $response = $this->get($this->getShowRoute($post->id));
        $response->assertSeeText($post->title);
        $response->assertViewIs('post.show');        
    }    

    public function test_all_post_related_content_is_visible()
    {
        // title
        // mins read
        // speaker name
        // date
        // location name
        // meta description 
        // meta keywords 
        // as a video
        // content
        // <title> also

        $metas = [
            'title', 'mins_read', 'speaker->name', 
            'readableDate()', 'location->name', 'video_src', 
            'content', 'meta["description"]', 'meta["keywords"]'
        ];

        $post = factory(Post::class)->create(['published_at' => now()]);
        $response = $this->get($this->getShowRoute($post->id));
        $response->assertStatus(200);

        foreach ($metas as $metaexe) {
            $response->assertSee($post->{$metaexe});
        }

        $response->assertSee($post->titleHtmlTag());

    }    
}
