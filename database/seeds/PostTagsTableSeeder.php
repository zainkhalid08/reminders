<?php

use App\Post;
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
    	$post = Post::all();
    	$tags = Tag::all();

    	foreach ($post as $post) {
    		foreach ($tags as $tag) {
				$post->tags()->attach($tag->id);    		
    		}
    	}
    }
}
