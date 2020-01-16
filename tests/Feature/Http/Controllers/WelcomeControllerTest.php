<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\Feature\Http\Requests\PostTrait;
use Tests\TestCase;

class WelcomeControllerTest extends TestCase
{
    use 
    // RefreshDatabase;
    PostTrait;

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
