<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfileSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('profiles')->insertOrIgnore([
            'id' => 1,
            'name' => 'Sophie',
            'age' => 22,
            'location' => 'New York',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Interdum posuere lorem ipsum dolor sit. Ornare arcu odio ut sem. Commodo elit at imperdiet dui accumsan sit. Nisi lacus sed viverra tellus in hac habitasse. Sociis natoque penatibus et magnis. Aliquet risus feugiat in ante metus dictum at. Rhoncus est pellentesque elit ullamcorper dignissim. Orci eu lobortis elementum nibh tellus molestie nunc. Elit ullamcorper dignissim cras tincidunt lobortis feugiat vivamus at augue.',
            'avatar' => 'sophie.jpg',
        ]);

        DB::table('profiles')->insertOrIgnore([
            'id' => 2,
            'name' => 'Bob',
            'age' => 22,
            'location' => 'New York',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Interdum posuere lorem ipsum dolor sit. Ornare arcu odio ut sem. Commodo elit at imperdiet dui accumsan sit. Nisi lacus sed viverra tellus in hac habitasse. Sociis natoque penatibus et magnis. Aliquet risus feugiat in ante metus dictum at. Rhoncus est pellentesque elit ullamcorper dignissim. Orci eu lobortis elementum nibh tellus molestie nunc. Elit ullamcorper dignissim cras tincidunt lobortis feugiat vivamus at augue.',
            'avatar' => 'bob.jpg',
        ]);
    }
}
