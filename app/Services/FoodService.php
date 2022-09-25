<?php

namespace App\Services;

use App\Models\Food;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class FoodService
{
    public function all(): Collection
    {
        return Food::all(['id', 'name', 'calorie']);
    }

    public function syncFoods(array $foods): void
    {
        Auth::user()->foods()->sync($foods);
    }
}
