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

        (new App\Location([
            'locatable_id' => $user1->id,
            'locatable_type' => App\User::class,
            'parent_id' => 2,
        ]))->save();

        $user2 = factory(App\User::class)->create([
            'name' => 'Bob',
            'email' => 'bob@example.com',
            'password' => bcrypt('test'),
            'balance' => 341,
        ]);

        (new App\Location([
            'locatable_id' => $user2->id,
            'locatable_type' => App\User::class,
            'parent_id' => 2,
        ]))->save();
    }
}
