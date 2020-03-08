<?php

use App\Models\OfferItem;
use Illuminate\Database\Seeder;

class OffersItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OfferItem::class, 10000)->create();
    }
}
