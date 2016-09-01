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

        factory(App\Room::class)->create(['ship_id' => $ship->id, 'name' => 'Operations']);
        factory(App\Room::class)->create(['ship_id' => $ship->id, 'name' => 'Navigation']);
        factory(App\Room::class)->create(['ship_id' => $ship->id, 'name' => 'Communications']);
        factory(App\Room::class)->create(['ship_id' => $ship->id, 'name' => 'Subsystems']);
        factory(App\Room::class)->create(['ship_id' => $ship->id, 'name' => 'Engineering']);
    }
}
