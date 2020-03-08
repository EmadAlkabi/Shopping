<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OfferItem;
use Faker\Generator as Faker;

$factory->define(OfferItem::class, function (Faker $faker) {
    return [
        'offer_id' => $faker->numberBetween(1, 1000),
        'item_id'  => $faker->numberBetween(1, 1000),
        'discount_rate' => $faker->numberBetween(1, 30),
        'created_at' => date('Y-m-d')
    ];
});
