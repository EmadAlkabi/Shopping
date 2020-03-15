<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enum\AnnouncementState;
use App\Models\Announcement;
use Faker\Generator as Faker;

$factory->define(Announcement::class, function (Faker $faker) {
    return [
        'target_id' => $faker->numberBetween(1, 1000),
        'type' => $faker->numberBetween(1, 2),
        'state' => AnnouncementState::ACTIVE,
        "title"       => $faker->company,
        "description" => $faker->sentence(10),
        "image"       => $faker->imageUrl(),
        "start_date"  => $faker->dateTimeBetween('-2years', '-1years'),
        "end_date"    => $faker->dateTimeBetween('-1years', '+3years'),
        "created_at"  => date('Y-m-d')
    ];
});
