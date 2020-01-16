<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\Feature\Http\Requests\PostTrait;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use 
    // RefreshDatabase;
    PostTrait;

    // INDEX

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

    public function test_meta_tags_for_description_is_present()
    {
        $response = $this->get($this->getIndexRoute());

        $metas = [
            'description' =>   'Older friday sermons of masjid al haram.',
        ];

        foreach ($metas as $key => $value) {
            $response->assertSee('<meta name="'.$key.'" content="'.$value.'">');
        }
    }

    // SHOW

    /*authorization test*/
    public function test_if_post_is_unpublished_then_404()
    {
        $post = factory(Post::class)->create(['published_at' => null]);
        $response = $this->get($this->getShowRoute($post->id));
        $response->assertNotFound();
    }

    public function test_if_post_is_published_then_should_see_post()
    {
        $post = factory(Post::class)->create(['published_at' => now()]);
        $response = $this->get($this->getShowRoute($post->id));
        $response->assertSeeText($post->title);
    }    

    /*authorization test*/
    public function test_if_visitor_IS_LOGGEDIN_then_404()
    {

        $post = factory(Post::class)->create(['published_at' => now()]);

        $user = factory(User::class)->create();

        $response = $this->actingAs($user)
                         ->get($this->getShowRoute($post->id));        
        $response->assertNotFound();
    }

    // if visitor isn't admin then he should see 404
    
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
