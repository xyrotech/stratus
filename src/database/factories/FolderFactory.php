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
$factory->define(Xyrotech\Stratus\Models\Folder::class, function (Faker\Generator $faker) {
    $user = factory(App\User::class)->create();
    return [
        'name' => $user->username,
        'user_id' => $user->id,
        'token' => function (array $folder){
            return hash('md5', $folder['name'] . $folder['user_id']);
        },
    ];
});