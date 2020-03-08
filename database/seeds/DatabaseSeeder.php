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
            CategoriesTableSeeder::class,
            ItemsTableSeeder::class,
            ReviewsTableSeeder::class,
            MediaItemTableSeeder::class,
            OffersTableSeeder::class,
            OffersItemsTableSeeder::class
        ]);
    }
}
