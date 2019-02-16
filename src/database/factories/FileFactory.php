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
use Illuminate\Support\Facades\Storage;
$factory->define(Xyrotech\Stratus\Models\File::class, function (Faker\Generator $faker) {
    $name = $faker->word . '.' . $faker->fileExtension;
    return [
        'name' => $name,
        'user_id' => function (array $file){
            Storage::put(Xyrotech\Stratus\Models\Folder::find($file['folder_id'])->name . '/' . $file['name'], 'My file name is ' . $file['name']);
            return Xyrotech\Stratus\Models\Folder::find($file['folder_id'])->user_id;
        },
        'token' =>  function (array $file){
            return hash_file('md5','storage/app/' . Xyrotech\Stratus\Models\Folder::find($file['folder_id'])->name . '/' . $file['name']);
        },
        'size' => function (array $file){
            return Storage::size(Xyrotech\Stratus\Models\Folder::find($file['folder_id'])->name . '/' . $file['name']);
        }
    ];
});