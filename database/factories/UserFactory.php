<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        "name" => $faker->name,
        "phone" => $faker->phoneNumber,
        "image" => "public/user/SU31TP4to2CKQCdsIl38Tp2CtR0ZzMhJGwQBmPWg.png",
        "address_1" => $faker->address,
        "address_2" => $faker->address,
        "lat" => $faker->latitude,
        "lng" => $faker->longitude,
        "created_at" => $faker->date("Y-m-d", "now"),
    ];
});
