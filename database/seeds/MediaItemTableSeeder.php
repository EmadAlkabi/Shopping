<?php

use App\Models\MediaItem;
use Illuminate\Database\Seeder;

class MediaItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(MediaItem::class, 5000)->create();
    }
}
