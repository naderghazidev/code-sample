<?php

namespace App\Services;

use App\Enums\Gender;

class BMRCalculator
{

    public function calculate(int $weight, int $height, int $age, Gender $gender): int
    {
        return ceil(
            (10 * $weight) +
            (6.25 * $height) -
            (5 * $age) +
            ($gender === Gender::MALE ? 5 : -161)
        );
    }
}
