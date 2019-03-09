<?php

use Faker\Generator as Faker;
use Illuminate\Http\UploadedFile;

$factory->define(App\Photo::class, function (Faker $faker) {
    return [
        'name' => UploadedFile::fake()->image($faker->sentence.'.jpg'),
    ];
});
