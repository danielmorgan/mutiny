<?php

use Illuminate\Database\Seeder;

class ShipsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ship = factory(App\Ship::class)->create([
            'name' => 'Boaty McBoatface',
        ]);

        (new App\Location([
            'locatable_id' => $ship->id,
            'locatable_type' => App\Ship::class,
            'parent_id' => 1,
        ]))->save();
    }
}
