<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$tags = [
    		'quran' => 'quran e paak, holy book, book of allah',
    		'relation with allah' => 'haqooq allah, allah ka haaq, ibadaat',
    		'relation with people' => 'haqooq al ibaad, bandoo k haqooq, loggon say salook',
    	];

    	foreach ($tags as $tag => $synonyms) {
	    	Tag::create([
	    		'name' => $tag,
	    		'synonyms' => $synonyms
	    	]);
    	}
    }
}
