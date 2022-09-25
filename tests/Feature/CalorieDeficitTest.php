<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class CalorieDeficitTest extends TestCase
{
    /** @test */
    public function can_calculate_deficit_calorie_for_a_user()
    {
        //Arrange
        $user = User::factory()->create([
            'tdee' => 2291
        ]);
        $this->actingAs($user);
        //Action
        $response = $this->postJson(route('calorie.deficit'), [
            'days' => 98,
            'weight_loss_amount' => 10
        ]);
        //Assert
        $response->assertSuccessful();
        $response->assertJsonPath('result', 1506);
    }

    /** @test */
    public function calculating_calorie_deficit_requires_authentication()
    {
        //Arrange

        //Action
        $response = $this->postJson(route('calorie.deficit'), [
            'days' => 98,
            'weight_loss_amount' => 10
        ]);
        //Assert
        $response->assertUnauthorized();
    }

    /** @test
     * @dataProvider invalidInputs()
     */
    public function calculating_calorie_deficit_invalid_inputs_are_detected($field, $errorKey, $invalidValue)
    {
        //Arrange
        $user = User::factory()->create([
            'tdee' => 2291
        ]);
        $this->actingAs($user);

        $attributes = [
            'days' => 98,
            'weight_loss_amount' => 10
        ];
        $attributes[$field] = $invalidValue;
        //Action
        $response = $this->postJson(route('calorie.deficit'), $attributes);
        //Assert
        $response->assertJsonValidationErrorFor($errorKey, 'result');
    }

    public function invalidInputs(): array
    {
        return [
            'weight_loss_amount not provided' => ['weight_loss_amount', 'weight_loss_amount', null],
            'weight_loss_amount is not integer' => ['weight_loss_amount', 'weight_loss_amount', 'invalid input'],

            'days not provided' => ['days', 'days', null],
            'days is not integer' => ['days', 'days', 'invalid input'],
        ];
    }
}
