<?php

namespace Database\Seeders;

use App\Models\Calorie;
use Illuminate\Database\Seeder;

class CaloriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $content = file_get_contents(storage_path('calories.json'));
        Calorie::query()->insert(json_decode($content, true));
    }
}
