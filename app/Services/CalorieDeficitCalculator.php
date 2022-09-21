<?php

namespace App\Services;

class CalorieDeficitCalculator
{

    public function calculate(int $tdee, int $days, int $weightLossTarget): int
    {
        return ceil($tdee - (3500 * 2.2 * $weightLossTarget) / $days);
    }
}
