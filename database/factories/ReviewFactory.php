<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use App\Models\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 500),
        'item_id' => $faker->numberBetween(1, 3074),
        'rate'    => $faker->numberBetween(1, 5),
        'comment' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
