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
        $user1 = factory(App\User::class)->create([
            'name' => 'Alice',
            'email' => 'alice@example.com',
            'password' => bcrypt('test'),
            'balance' => 25000,
        ]);

        $user2 = factory(App\User::class)->create([
            'name' => 'Bob',
            'email' => 'bob@example.com',
            'password' => bcrypt('test'),
            'balance' => 341,
        ]);

        // Get a random room and put both users in it
        $ship = App\Ships\Ship::first();
        $room = App\Location::where('locatable_type', 'like', '%Room')->get()->random();
        $user1->location->parent_id = $room->id;
        $user1->location->save();
        $user2->location->parent_id = $room->id;
        $user2->location->save();
    }
}
