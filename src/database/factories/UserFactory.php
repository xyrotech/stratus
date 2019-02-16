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
$factory->define(Xyrotech\Stratus\Models\User::class, function (Faker\Generator $faker) {
    static $password;
    $first_name = $faker->firstName;
    $last_name = $faker->lastName;
    return [
        'name' => $first_name . ' ' . $last_name,
        'email' => $faker->unique()->safeEmail,
        'username' => strtolower(substr($first_name,0,1) . $last_name),
        'locked' => false,
        'active' => true,
        'role' => 2,
        'password' => bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});