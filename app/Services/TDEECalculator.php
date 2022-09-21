<?php

namespace App\Services;

use App\Enums\ActivityLevel;

class TDEECalculator
{

    public function calculate(int $bmr, ActivityLevel $activityLevel): int
    {
        return ceil($bmr * $activityLevel->value);
    }
}
