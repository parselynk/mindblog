<?php

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'content' => $faker->paragraph,
        'author_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
