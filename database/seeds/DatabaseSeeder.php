<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TagsTableSeeder::class);
        $this->call(LocationsTableSeeder::class);
        $this->call(SpeakersTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(PostTagsTableSeeder::class);
    }
}
