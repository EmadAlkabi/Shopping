<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Enum\ItemState;
use App\Models\Category;
use App\Models\Item;
use App\Models\Vendor;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
        "vendor_id"     => Vendor::all()->random()->id,
        "offline_id"    => null,
        "name"          => $faker->company,
        "details"       => $faker->paragraph(),
        "barcode"       => $faker->ean13,
        "code"          => $faker->ean8,
        "currency"      => $faker->randomKey(array("IQD" => "Dinar", "USD" => "Dollar")),
        "price"         => $faker->randomFloat(8,100, 200000),
        "unit"          => "unknown",
        "quantity"      => $faker->numberBetween(0, 1000),
        "category_id"   => $faker->randomElement(array(null, Category::all()->random()->id)),
        "deleted"       => $faker->numberBetween(0,1),
        "created_at"    => $faker->dateTimeBetween('-30years', 'now')
    ];
});
