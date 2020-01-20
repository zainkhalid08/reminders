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
        if (Location::count()) {
            return;
        }
        
    	$locations = [
    		'Masjid Al Haram',
    	];

    	foreach ($locations as $location) {
	    	Location::create([
	    		'name' => $location,
	    	]);
    	}
    }
}
