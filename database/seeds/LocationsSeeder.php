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
        $universe = new App\Location([
            'parent_id' => null,
            'name' => 'Universe',
            'description' => 'The expansive void stretches into an infinity of stars.',
            'image' => '/img/locations/universe.jpg',
            'shipCanEnter' => true,
        ]);

        $universe->save();

        (new App\Location([
            'parent_id' => $universe->id,
            'name' => 'Space Station V',
            'description' => 'The station is made of two counter-rotating tori, one of which is still under construction. It\'s hulking metal beams gleam dully like exposed bone. A dim light leaks out of the docking port, caused by the approach lighting which guides ships to and from their designated berths.' ,
            'image' => '/img/locations/station.jpg',
            'shipCanEnter' => true,
        ]))->save();

        (new App\Location([
            'parent_id' => $universe->id,
            'name' => 'Asteroid',
            'description' => 'A large but otherwise unremarkable asteroid.' ,
            'image' => '/img/locations/asteroid.jpg',
            'shipCanEnter' => true,
        ]))->save();
    }
}
