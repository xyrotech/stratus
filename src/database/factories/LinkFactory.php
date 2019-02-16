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
$factory->define(Xyrotech\Stratus\Models\Link::class, function (Faker\Generator $faker) {
    return [
        'password' => function (array $link){
            return bcrypt('password');
        },
        'expire_at' => function (array $link){
            return Xyrotech\Stratus\Models\File::find($link['linkable_id'])->created_at->addDay()->endOfDay();
        },
        'linkable_type' => 'App\File'
    ];
});