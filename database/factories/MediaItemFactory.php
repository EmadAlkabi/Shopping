<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use App\Models\MediaItem;
use Faker\Generator as Faker;

$factory->define(MediaItem::class, function (Faker $faker) {
    return [
        'item_id' => Item::all()->random()->id,
        'type' => $faker->numberBetween(1, 2),
        'url' => $faker->imageUrl(),
        'created_at' => date('Y-m-d')
    ];
});
