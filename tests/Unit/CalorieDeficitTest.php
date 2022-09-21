<?php

namespace Tests\Unit;

use App\Services\CalorieDeficitCalculator;
use Tests\TestCase;

class CalorieDeficitTest extends TestCase
{
    /** @test */
    public function can_calculate_daily_calories_required_to_lose_a_specific_amount_of_weight()
    {
        //Arrange
        $calorieDeficitCalculator = new CalorieDeficitCalculator();
        //Action
        $dailyRequiredCalorie = $calorieDeficitCalculator->calculate(2291, 98, 10);
        //Assert
        $this->assertSame(1506, $dailyRequiredCalorie);
    }
}
