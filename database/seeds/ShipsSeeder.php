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
        factory(App\Ships\Ship::class, 3)->create()->each(function($ship) {
            foreach (['Operations', 'Communications', 'Navigation', 'Systems', 'Engineering'] as $type) {
                $ship->rooms()->create(['type' => $type]);
            }
        });
    }
}
