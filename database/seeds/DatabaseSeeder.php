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
        // commented so when we install fresh then we don't have any dummy data
        // $this->call(TagsTableSeeder::class);
        // $this->call(LocationsTableSeeder::class);
        // $this->call(SpeakersTableSeeder::class);
        // $this->call(PostsTableSeeder::class);
        // $this->call(PostTagsTableSeeder::class);
        $this->call(SurahsTableSeeder::class);
    }
}
