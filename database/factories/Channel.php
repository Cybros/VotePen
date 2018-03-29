<?php

use Faker\Generator as Faker;

$factory->define(\App\Channel::class, function (Faker $faker) {
    return [
        'name' => str_slug($faker->name, ''),
        'description' => $faker->paragraph(),
        'nsfw' => 0,
        'avatar' => 'https://cdn.jsdelivr.net/npm/@votepen/cdn@1.0.0/imgs/channel-avatar.png',
        'color' => 'Blue',
    ];
});