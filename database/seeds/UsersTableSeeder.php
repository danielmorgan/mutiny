<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the test user.
     *
     * @return void
     */
    public function run()
    {
        $ship = App\Ships\Ship::first();

        $user1 = factory(App\User::class)->create([
            'name' => 'Alice',
            'email' => 'alice@example.com',
            'password' => bcrypt('test'),
            'balance' => 25000,
            'ship_id' => $ship->id,
        ]);

        $user2 = factory(App\User::class)->create([
            'name' => 'Bob',
            'email' => 'bob@example.com',
            'password' => bcrypt('test'),
            'balance' => 10000,
            'ship_id' => $ship->id,
        ]);

        // Get a random room and put both users in it
        $room = App\Location::where([
            ['locatable_type', 'like', '%Room'],
            ['parent_id', $ship->location->id],
        ])->get()->random();
        $user1->location->parent_id = $room->id;
        $user1->location->save();
        $user2->location->parent_id = $room->id;
        $user2->location->save();
    }
}
