<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Offer;
use Faker\Generator as Faker;

$factory->define(Offer::class, function (Faker $faker) {
    return [
        "vendor_id"   => 0,
        "title"       => $faker->company,
        "description" => $faker->sentence(10),
        "image"       => $faker->imageUrl(),
        "start_date"  => $faker->dateTimeBetween('-2years', '-1years'),
        "end_date"    => $faker->dateTimeBetween('-1years', '+3years'),
        "created_at"  => date('Y-m-d')
    ];
});
