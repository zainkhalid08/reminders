<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class WelcomeControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The older posts text on the button.
     *
     * @var string
     */
    protected $olderPostsText = 'Older Sermons';

    // HELPERS
    public function getLimit() : int
    {
       return config('post.welcome');
    }   

    function test_ONLY_PUBLISHED_posts_are_shown()
    {
        $post = factory(Post::class)->create(['published_at' => now()]);
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);
        $response->assertSeeText($post->title);
    }

    function test_unpublished_posts_are_NOT_shown()
    {
        $post = factory(Post::class)->create(['published_at' => null]);
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);
        $response->assertDontSeeText($post->title);
    }

    function test_only_latest_posts_are_shown()
    {
        $posts = factory(Post::class, 10)->create(['published_at' => now()]);
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);

        // Latest
        $posts = Post::latest()->limit($this->getLimit())->get();

        foreach ($posts as $post) {
            $response->assertSeeText($post->title);
        }

    }

    function test_only_LIMIT_posts_are_shown()
    {
        $posts = factory(Post::class, $this->getLimit())->create(['published_at' => now()]);
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);
        foreach ($posts as $post) {
            $response->assertSeeText($post->title);
        }
    }

    function test_more_than_LIMIT_posts_are_not_shown()
    {
        $posts = factory(Post::class, $this->getLimit() + 1)->create(['published_at' => now()]);
        $extraPost = $posts->reverse()->first();
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);
        $response->assertDontSeeText($extraPost->title);
    }

    // Older Sermon Button Test
    function test_if_posts_are_EQUAL_to_LIMIT_then_older_sermons_button_is_not_shown()
    {
        $posts = factory(Post::class, $this->getLimit())->create(['published_at' => now()]);
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);
        $response->assertDontSeeText($this->olderPostsText);
    }    

    // Older Sermon Button Test
    function test_only_if_posts_are_MORE_than_LIMIT_only_then_older_sermons_button_is_shown()
    {
        $posts = factory(Post::class, $this->getLimit() + 1)->create(['published_at' => now()]);
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);
        $response->assertSeeText($this->olderPostsText);
    }

    // MISC TESTS
    function test_root_shows_the_welcome_page()
    {
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);
        $response->assertViewIs('welcome');        
    } 

}
