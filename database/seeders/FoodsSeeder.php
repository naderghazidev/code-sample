<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Seeder;

class FoodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = file_get_contents(storage_path('foods.json'));
        Food::query()->insert(json_decode($content, true));
    }
}
