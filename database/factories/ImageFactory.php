<?php

use Faker\Generator as Faker;

$factory->define(App\Image::class, function (Faker $faker) {
    return [
        "title" => $faker->words(mt_rand(1, 3), true),
        "file" => "default.jpg",
    ];
});
