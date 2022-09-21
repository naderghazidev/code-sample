<?php

namespace Tests\Unit;

use App\Enums\ActivityLevel;
use App\Services\TDEECalculator;
use PHPUnit\Framework\TestCase;

class TDEECalculatorTest extends TestCase
{
    /** @test
     * @dataProvider inputs()
     */
    public function can_calculate_tdee($activityLevel, $expectedResult)
    {
        //Arrange
        $tdeeCalculator = new TDEECalculator();
        //Action
        $tdee = $tdeeCalculator->calculate(1909, $activityLevel);
        //Assert
        $this->assertSame($expectedResult, $tdee);
    }

    private function inputs(): array
    {
        return [
            'little to no exercise' => [ActivityLevel::SEDENTARY, 2291],
            'light exercise' => [ActivityLevel::LIGHTLY_ACTIVE, 2625],
            'moderate exercise' => [ActivityLevel::MODERATELY_ACTIVE, 2959],
            'hard exercise' => [ActivityLevel::VERY_ACTIVE, 3294],
            'extreme exercise' => [ActivityLevel::EXTREMELY_ACTIVE, 3628],
        ];
    }
}
