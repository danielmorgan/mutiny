<?php

use App\Rooms\CICRoom;
use App\Rooms\CommunicationsRoom;
use App\Rooms\NavigationRoom;
use App\Rooms\SystemsRoom;
use App\Rooms\EngineeringRoom;
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
                new CICRoom,
                new CommunicationsRoom,
                new NavigationRoom,
                new SystemsRoom,
                new EngineeringRoom,
            ]);
        });
    }
}
