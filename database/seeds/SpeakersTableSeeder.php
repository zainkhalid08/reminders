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
        $location = Location::firstOrFail();

    	$speakers = [
            [
        		'name' => 'Sheikh Salaah Budaair',
                'location_id' => $location->id,
            ],
            [
        		'name' => 'Sheikh Faisal Ghazzawi',
                'location_id' => $location->id,
            ],
            [
        		'name' => 'Sheikh Ali Hudhayfy',
                'location_id' => $location->id + 1
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
