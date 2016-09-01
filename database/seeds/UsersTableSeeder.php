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

        $room = App\Room::first();
        $user1->location->parent_id = $room->location->id;
        $user1->location->save();
        $user2->location->parent_id = $room->location->id;
        $user2->location->save();
    }
}
