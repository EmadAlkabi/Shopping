<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class)->create([
            'parent_id' => null,
            'name' => "كهربائيات",
            'terminal' => 1,
            'created_at' => date('Y-m-d')
        ]);

        factory(Category::class)->create([
            'parent_id' => null,
            'name' => "الكترونيات",
            'terminal' => 1,
            'created_at' => date('Y-m-d')
        ]);

        factory(Category::class)->create([
            'parent_id' => null,
            'name' => "اخرى",
            'terminal' => 1,
            'created_at' => date('Y-m-d')
        ]);
    }
}
