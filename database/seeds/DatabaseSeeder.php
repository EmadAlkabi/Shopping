<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            ItemsTableSeeder::class,
            ReviewsTableSeeder::class,
            MediaItemTableSeeder::class,
            OffersTableSeeder::class,
            OffersItemsTableSeeder::class,
            OrdersTableSeeder::class,
            OrdersItemsTableSeeder::class
        ]);
    }
}
