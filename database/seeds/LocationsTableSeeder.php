<?php

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
        (new App\Location([
            'name' => 'Universe',
            'locatable_id' => null,
            'locatable_type' => null,
            'parent_id' => null,
        ]))->save();
    }
}
