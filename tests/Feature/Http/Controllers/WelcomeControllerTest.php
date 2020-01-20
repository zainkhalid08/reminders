<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Feature\Http\Requests\PostTrait;
use Tests\TestCase;

/**
 * USAGE
 *
 * 1. use with RefreshDatabase
 *
 * NOTE: REDIRECT tests mentioned
 * under '// REDIRECT' heading
 * just test partial feature
 * for full DUSK is must.
 *
 */
class WelcomeControllerTest extends TestCase
{
    use 
    RefreshDatabase,
    PostTrait;

    /**
     * The older posts text on the button.
     *
     * @var string
     */
    protected $olderPostsText = 'Older Friday Sermons';

    // HELPERS
    public function getLimit() : int
    {
       return config('post.welcome');
    }   

    /* CONTROLLER FUNCTIONALITY TESTS */
    // PUBLISHED POSTS
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

    // LATEST BY PUBLISHED POSTS
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

    // LIMIT TESTS
    function test_more_than_LIMIT_posts_are_not_shown()
    {
        $posts = factory(Post::class, $this->getLimit() + 1)->create(['published_at' => now()]);
        $extraPost = $posts->reverse()->first();
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);
        $response->assertDontSeeText($extraPost->title);
    }

    // OLDER SERMON BUTTON 
    function test_if_posts_are_EQUAL_to_LIMIT_then_older_sermons_button_is_not_shown()
    {
        $posts = factory(Post::class, $this->getLimit())->create(['published_at' => now()]);
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);
        $response->assertDontSeeText($this->olderPostsText);
    }    

    function test_only_if_posts_are_MORE_than_LIMIT_only_then_older_sermons_button_is_shown()
    {
        $posts = factory(Post::class, $this->getLimit() + 1)->create(['published_at' => now()]);
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);
        $response->assertSeeText($this->olderPostsText);
    }

    function test_all_seo_tags_for_welcome_page_are_present()
    {
        $response = $this->get(route('welcome'));
        $response->assertSee( '<title>'.config('seo.welcome.title') );
        foreach (config('seo.welcome.meta') as $key => $value) {
            $response->assertSee( '<meta name="'.$key.'" content="'.$value.'">' );
        }
    }


    // REDIRECTS
    function test_OLDER_FRIDAY_SERMONS_button_LINK_IS_PRESENT_with_correct_redirect()
    {
        $response = $this->get(route('welcome'));
        $response->assertSee('<a href="'.route('feedback').'" target="_blank">Feedback</a>');
    }

    function test_THANKS_LINK_IS_PRESENT_with_correct_redirect()
    {
        $response = $this->get(route('welcome'));
        $response->assertSee('<a href="#thanks" data-toggle="modal" data-target="#thanks">Thanks</a>');
    }

    function test_ATTRIBUTION_LINK_IS_PRESENT_with_correct_redirect()
    {
        $response = $this->get(route('welcome'));
        $response->assertSee('<a rel="license" href="http://creativecommons.org/licenses/by-nd/4.0/" target="_blank"><img alt="Creative Commons License" title="Attribution-NoDerivatives 4.0 International (CC BY-ND 4.0)" style="border-width:0" src="http://rfg.localhost.com/img/cc.webp" /></a>');
    }

    // MISC TESTS
    function test_root_shows_the_welcome_page()
    {
        $response = $this->get(route('welcome'));
        $response->assertStatus(200);
        $response->assertViewIs('welcome');        
    } 



}
