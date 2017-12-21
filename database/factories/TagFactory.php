<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Tag::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->words(mt_rand(1, 3), true),
    ];
});