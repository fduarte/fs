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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Person::class, function (Faker\Generator $faker) {
    static $password;

    $faker->seed(1234);

    return [
        'first_name' => $faker->unique()->name,
        'last_name' => $faker->unique()->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $faker->unique()->password,
//        'remember_token' => str_random(10),
    ];
});
