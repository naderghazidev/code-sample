<?php

namespace App\Services;

use App\Enums\ActivityLevel;

class TDEECalculator
{

    public function calculate(int $bmr, ActivityLevel $activityLevel): int
    {
        $activityLevelValue = match ($activityLevel) {
            ActivityLevel::SEDENTARY => 1.2,
            ActivityLevel::LIGHTLY_ACTIVE => 1.375,
            ActivityLevel::MODERATELY_ACTIVE => 1.55,
            ActivityLevel::VERY_ACTIVE => 1.725,
            ActivityLevel::EXTREMELY_ACTIVE => 1.9,
        };

        return ceil($bmr * $activityLevelValue);
    }
}
