<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    use RefreshDatabase;

    // HELPERS
    public function getIndexRoute() : string
    {
       return route('post.index');
    }   

    public function getShowRoute($id) : string
    {
       return route('post.show', $id);
    }   

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

    function test_only_latest_posts_are_shown()
    {
        $posts = factory(Post::class, 10)->create(['published_at' => now()]);
        $response = $this->get($this->getIndexRoute());
        $response->assertStatus(200);

        // Latest
        $posts = Post::latest()->get();

        foreach ($posts as $post) {
            $orderedPostTitles[] = $post->title;
        }
        $response->assertSeeTextInOrder($orderedPostTitles);

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
