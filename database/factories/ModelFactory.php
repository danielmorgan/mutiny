<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Ship::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->city,
    ];
});

$factory->define(App\Room::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->randomElement([
            'Operations',
            'Navigation',
            'Communications',
            'Subsystems',
            'Engineering',
        ]),
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});
