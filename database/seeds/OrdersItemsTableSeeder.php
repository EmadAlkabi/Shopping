<?php

use App\Models\OrderItem;
use Illuminate\Database\Seeder;

class OrdersItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(OrderItem::class, 1000)->create();
    }
}
