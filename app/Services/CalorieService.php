<?php

namespace App\Services;

use App\Models\Calorie;
use Illuminate\Database\Eloquent\Collection;

class CalorieService
{

    public function all(): Collection
    {
        return Calorie::all(['id','name','calorie']);
    }
}
