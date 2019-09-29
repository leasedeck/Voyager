<?php

/** @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Models\User::class, function (Faker $faker) {
    return [
        'voornaam' => $faker->firstName,
        'achternaam' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$JmVqy14i6l9lqxeCOl.BcesUNwgG9mf0sEXFH0cS44PUkAvpDCic6', // password
        'remember_token' => str_random(10),
    ];
});
