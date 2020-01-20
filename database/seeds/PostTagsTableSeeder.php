<?php

use App\Post;
use App\PostTag;
use App\Tag;
use Illuminate\Database\Seeder;

class PostTagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$posts = Post::all();
    	$tags = Tag::all();

        if (PostTag::count()) {
            return;
        }

    	foreach ($posts as $post) {
    		foreach ($tags as $tag) {
				$post->tags()->attach($tag->id);    		
    		}
    	}
    }
}
