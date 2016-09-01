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
    }
}
