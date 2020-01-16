<?php

use App\Speaker;
use App\Location;
use App\Post;
use App\User;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$speaker = Speaker::firstOrFail();
    	$location = Location::firstOrFail();
    	$user = User::firstOrFail();

    	$posts = [
    		[
    			'title' => 'The Last Day',
    			'content' => '<p>Rhis is a sample parals dsf ksd jlsdfj </p> 
    			<i> Here is a i tag italics </i> <b> bold oe is here  dfddddddddddf ddddd d d d dsdfdas fd sfa sdf asd f asf dsfas f  </b> <q> tesing a ablock quote sinsdf msdlf sdj ls lf jds  </q>',
    			'speaker_id' => $speaker->id,
    			'location_id' => $location->id,
    			'date' => date('Y-m-d h:i:s'),
    			'video_src' => 'https://www.youtube.com/embed/7h3YI9UJ21I',
    			'image_src' => 'https://www.gstatic.com/webp/gallery3/1.png',
    			'mins_read' => 3,
    			'user_id' => $user->id,
    			'published_at' => date('Y-m-d h:i:s'),
    		], 
    		[
    			'title' => 'The Natural Inclination',
    			'content' => '<p>The natural inclination Rhis is a sample parals dsf ksd jlsdfj </p> 
    			<i> Here is a i tag italics </i> <b> bold oe is here  dfddddddddddf ddddd d d d dsdfdas fd sfa sdf asd f asf dsfas f  </b> <q> tesing a ablock quote sinsdf msdlf sdj ls lf jds  </q>',
    			'speaker_id' => $speaker->id + 2,
    			'location_id' => $location->id + 1,
    			'date' => date('Y-m-d h:i:s'),
    			'video_src' => 'https://www.youtube.com/embed/1w5dwdblh58',
    			'image_src' => 'https://www.gstatic.com/webp/gallery3/1.png',
    			'mins_read' => 3,
    			'user_id' => $user->id,
    			'published_at' => date('Y-m-d h:i:s'),
    		], 
    		[
    			'title' => 'Staying Focused on What is Important and Not Being Diverted',
    			'content' => '<p>The natural inclination Rhis is a sample parals dsf ksd jlsdfj </p> 
    			<i> Here is a i tag italics </i> <b> bold oe is here  dfddddddddddf ddddd d d d dsdfdas fd sfa sdf asd f asf dsfas f  </b> <q> tesing a ablock quote sinsdf msdlf sdj ls lf jds  </q>',
    			'speaker_id' => $speaker->id + 1,
    			'location_id' => $location->id,
    			'date' => date('Y-m-d h:i:s'),
    			'video_src' => 'https://www.youtube.com/embed/QxqmSgn3sbw',
    			'image_src' => 'https://www.gstatic.com/webp/gallery3/1.png',
    			'mins_read' => 3,
    			'user_id' => $user->id,
    			'published_at' => date('Y-m-d h:i:s'),
    		],
    	];

    	foreach ($posts as $post) {

	        Post::create([
	        	'title' => $post['title'],
		        'content' => $post['content'],
		        'speaker_id' => $post['speaker_id'],
		        'location_id' => $post['location_id'],
		        'date' => $post['date'],
		        'video_src' => $post['video_src'],
		        'image_src' => $post['image_src'],
		        'mins_read' => $post['mins_read'],
		        'user_id' => $post['user_id'],
		        'published_at' => $post['published_at'],
	        ]);
    		
    	}


    }
}
