<?php

use App\Location;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$locations = [
    		'Masjid Al Haram',
    		'Masjid An Nabawi'
    	];

    	foreach ($locations as $location) {
	    	Location::create([
	    		'name' => $location,
	    	]);
    	}
    }
}
