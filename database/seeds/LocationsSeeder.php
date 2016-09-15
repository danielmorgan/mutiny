<?php

use Illuminate\Database\Seeder;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new App\Location([
            'parent_id' => null,
            'name' => 'Universe',
            'description' => 'The expansive void stretches into an infinity of stars.',
            'image' => '/img/locations/universe.jpg',
            'shipCanEnter' => true,
        ]))->save();
    }
}
