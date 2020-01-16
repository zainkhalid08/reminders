<?php

namespace Tests\Feature\Http\Requests;

use App\Mail\FeedbackArrived;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\Feature\Http\Requests\PostTrait;
use Tests\TestCase;

class PostShowRequestTest extends TestCase
{
    use PostTrait;

    public function test_an_auth_non_admin_user_trying_to_access_an_unpublished_post_should_see_404()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['published_at' => null]);

        $response = $this->actingAs($user)
                             ->get(route('post.show', $post->id));

        $response->assertStatus(404);
    }
    
    public function test_real_admin_can_see_an_unpublished_post()
    {
        $user = User::first();
        $post = factory(Post::class)->create(['published_at' => null]);

        $response = $this->actingAs($user)
                             ->get(route('post.show', $post->id));

        $response->assertStatus(200);
    }

}
