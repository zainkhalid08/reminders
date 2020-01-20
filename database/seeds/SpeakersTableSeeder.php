<?php

use App\Speaker;
use App\Location;
use Illuminate\Database\Seeder;

class SpeakersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Speaker::count()) {
            return;
        }

        $location = Location::firstOrFail();

    	$speakers = [
            [
        		'name' => 'Sheikh Saud Shuraim',
                'location_id' => $location->id,
            ],
    	];

    	foreach ($speakers as $speaker) {
	    	Speaker::create([
	    		'name' => $speaker['name'],
                'location_id' => $speaker['location_id'],
	    	]);
    	}
    }
}
