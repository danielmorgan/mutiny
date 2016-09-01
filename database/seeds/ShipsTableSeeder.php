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
        // Createa ship with two rooms
        $ship = factory(App\Ships\Ship::class)->create([
            'name' => 'Boaty McBoatface',
        ]);
        (new App\Location([
            'name' => null,
            'locatable_id' => null,
            'locatable_type' => App\Ships\Rooms\EngineeringRoom::class,
            'parent_id' => $ship->location->id,
        ]))->save();
        (new App\Location([
            'name' => null,
            'locatable_id' => null,
            'locatable_type' => App\Ships\Rooms\OperationsRoom::class,
            'parent_id' => $ship->location->id,
        ]))->save();


        // Create a ship with one room
        $ship = factory(App\Ships\Ship::class)->create([
            'name' => 'Tugger',
        ]);
        (new App\Location([
            'name' => null,
            'locatable_id' => null,
            'locatable_type' => App\Ships\Rooms\OperationsRoom::class,
            'parent_id' => $ship->location->id,
        ]))->save();
    }
}
