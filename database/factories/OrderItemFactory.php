<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Item;
use App\Models\OrderItem;
use Faker\Generator as Faker;

$factory->define(OrderItem::class, function (Faker $faker) {
    $item = Item::all()->random();
    return [
        'user_id'  => $faker->numberBetween(1, 500),
        'item_id'  => $item->id,
        'currency' => $item->currency,
        'price'    => $item->price,
        'quantity' => $faker->numberBetween(1, 3),
        'cart' => $faker->numberBetween(0, 1),
        'order_id' => null,
        'created_at' => date("Y-m-d")
    ];
});
