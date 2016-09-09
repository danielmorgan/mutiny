<?php

use Illuminate\Database\Seeder;

class ShipsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Ships\Ship::class)->create()->each(function($ship) {
            $ship->rooms()->saveMany([
                new \App\Rooms\CombatInformationCentreRoom,
                new \App\Rooms\CombatInformationCentreRoom,
                new \App\Rooms\CombatInformationCentreRoom,
                new \App\Rooms\CombatInformationCentreRoom,
                new \App\Rooms\EngineeringRoom,
                new \App\Rooms\EngineeringRoom,
                new \App\Rooms\EngineeringRoom,
            ]);
        });
    }
}
