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
            'name' => 'John Doe',
            'email' => 'test@example.com',
            'password' => bcrypt('test')
        ]);
    }
}
