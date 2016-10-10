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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Game::class, function (Faker\Generator $faker) {
    return [
    	'user_1_id' => $faker->numberBetween(1,10),
    	'user_2_id' => $faker->numberBetween(1,10),
    	'user_1_score' => $faker->numberBetween(1,100),
    	'user_2_score' => $faker->numberBetween(1,100),
    ];
});
