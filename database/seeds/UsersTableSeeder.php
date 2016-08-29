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
        factory(App\User::class)->create([
            'name' => 'Alice',
            'email' => 'alice@example.com',
            'password' => bcrypt('test'),
            'balance' => 25000
        ]);

        factory(App\User::class)->create([
            'name' => 'Bob',
            'email' => 'bob@example.com',
            'password' => bcrypt('test'),
            'balance' => 341
        ]);
    }
}
