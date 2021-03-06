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
$factory->define(findparking\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(findparking\Brand::class, function(Faker\Generator $faker) {
	return [
		'brand_name' => $faker->name
	];
});

$factory->define(findparking\Administrator::class, function(Faker\Generator $faker) {
    static $password;

    return [
        'administrator_first_name' => $faker->name, 
        'administrator_last_name' => $faker->lastName,
        'name' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('12345678')
    ];
});
