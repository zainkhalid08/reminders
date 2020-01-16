<?php

namespace Tests\Feature;

use App\Location;
use App\Post;
use App\Speaker;
use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AdminPostControllerTest extends TestCase
{
    // use 
    //     RefreshDatabase; 

    public function validFields($overrides = [])
    {
        return array_merge([
            'title' => 'Last Day',
            'speaker' => 'Sheikh Sudais',
            'location' => 'Masjid Al Haram',
            'date' => '2020-01-23',
            'video_src' => 'https://www.youtube.com/embed/KJq08q7qfr4',
            'content' => '<p>qiyamah, last day, quran, reality</p>',
            'meta' => [
                'description' => 'The last day of the world',
                'keywords' => 'qiyamah, last day, quran, reality',
            ],
            'mins_read' => '3',
            'tags' => 'qiyamah, last day, quran, reality',
        ], $overrides);
    }

    protected function stringComparatorAssertion($first, $second)
    {
        return $this->assertEquals(strtolower($first), strtolower($second));
    }

    public function test_post_is_created_in_db()
    {
        $user = User::first();

        $data = $this->validFields();

        // $this->withoutExceptionHandling();

        $response = $this->actingAs($user)
                         ->post(route('admin.post.store'), $data);        

        $post = Post::latest()->first();
        $this->stringComparatorAssertion($post->title, $data['title']);
        $this->stringComparatorAssertion($post->date, $data['date'].' 00:00:00');
        $this->stringComparatorAssertion($post->video_src, $data['video_src']);
        $this->stringComparatorAssertion($post->content, $data['content']);
        $this->stringComparatorAssertion($post->mins_read, $data['mins_read']);

        $this->assertEquals(json_encode($post->meta), json_encode($data['meta']));


        // speakers table
        $speaker = Speaker::latest()->first();
        $this->stringComparatorAssertion($speaker->name, $data['speaker']);

        // locations table
        $location = Location::latest()->first();
        $this->stringComparatorAssertion($location->name, $data['location']);

        // tags table
        $tags = explode(',', $data['tags']);
        foreach ($tags as $tag) {
            $exists = Tag::where('name', $tag)->exists();
            $this->assertEquals(true, $exists);
        }

        // post_tags table
        $postTags = $post->tags->toArray();

        for ($i = 0; $i < count($postTags); $i++) { 
            $this->stringComparatorAssertion($postTags[$i]['name'], $tags[$i]);
        }
    }
}
