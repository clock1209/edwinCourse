<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    $users_registered = \App\User::get()->count();
    return [
        'title' => $faker->unique()->words(rand(1, 3), true),
        'comment' => $faker->sentence(rand(2, 8)),
        'user_id' => $faker->numberBetween(1, $users_registered),
    ];
});
