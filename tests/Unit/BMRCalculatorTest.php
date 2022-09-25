<?php

namespace Tests\Unit;

use App\Enums\Gender;
use App\Services\BMRService;
use PHPUnit\Framework\TestCase;

class BMRCalculatorTest extends TestCase
{
    /** @test */
    public function can_calculate_bmr_for_males()
    {
        //Arrange
        $bmiCalculator = new BMRService();
        //Action
        $bmi = $bmiCalculator->calculate(90, 183, 28,Gender::MALE);
        //Assert
        $this->assertSame(1909,$bmi);
    }

    /** @test */
    public function can_calculate_bmr_for_females()
    {
        //Arrange
        $bmiCalculator = new BMRService();
        //Action
        $bmi = $bmiCalculator->calculate(90, 183, 28,Gender::FEMALE);
        //Assert
        $this->assertSame(1743,$bmi);
    }
}
