<?php

namespace Tests\Feature\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\Feature\Http\Requests\PostTrait;
use Tests\TestCase;

trait PostControllerIndexMethodTest 
{
    /* CONTROLLER FUNCTIONALITY*/
    function test_all_seo_tags_for_all_posts_page_are_present()
    {
        $response = $this->get($this->getIndexRoute());
        $response->assertSee( '<title>'.config('seo.post-index.title') );
        foreach (config('seo.post-index.meta') as $key => $value) {
            $response->assertSee( '<meta name="'.$key.'" content="'.$value.'">' );
        }
    }


    function test_ONLY_PUBLISHED_posts_are_shown()
    {
        $post = factory(Post::class)->create(['published_at' => now()]);
        $response = $this->get($this->getIndexRoute());
        $response->assertStatus(200);
        $response->assertSeeText($post->title);
    }

    function test_UNPUBLISHED_posts_are_NOT_shown()
    {
        $post = factory(Post::class)->create(['published_at' => null]);
        $response = $this->get($this->getIndexRoute());
        $response->assertStatus(200);
        $response->assertDontSeeText($post->title);
    }

    // PAGINATION
    function test_if_posts_are_more_than_pagination_limit_then_pagination_links_are_available()
    {
        $numberOfPosts = (int) config('post.post-index');        
        $posts = factory(Post::class, $numberOfPosts + 3)->create(['published_at' => now()]);
        $response = $this->get($this->getIndexRoute());

        $posts = Post::latestPublishedFirst()->paginate(config('post.post-index'));

        $response->assertStatus(200);

        $response->assertSee($posts->render());
    }

    function test_more_than_PAGINATION_CONFIGUTED_LIMIT_number_of_posts_are_not_shown()
    {
        $numberOfPosts = (int) config('post.post-index');        
        $posts = factory(Post::class, $numberOfPosts + 3)->create(['published_at' => now()]);
        $extraPost = $posts->reverse()->first();

        $response = $this->get($this->getIndexRoute());
        $response->assertStatus(200);
        $response->assertDontSeeText($extraPost->title);
    }

    function test_latest_published_posts_are_shown_first()
    {
        // NOTE: This test depends on the fact that we
        // increment the minutes... if we want to 
        // test for more then make sure it is
        // > 9 eg. 0, 5, 9, 10, 11, 15...

        $minutes = [
            0, 5, 9
        ];

        foreach ($minutes as $minute) {
            $posts[] = factory(Post::class)->create(['published_at' => now()->addMinutes($minute)]);
        }

        $posts = array_reverse($posts);

        foreach ($posts as $post) {
            $orderedPostTitles[] = $post->title;
        }

        $response = $this->get($this->getIndexRoute());

        $response->assertStatus(200);

        $response->assertSeeTextInOrder($orderedPostTitles);
    }

}
