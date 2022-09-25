<?php

namespace Tests\Feature;

use App\Models\Food;
use App\Models\User;
use Database\Seeders\FoodsSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FoodSubmissionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            FoodsSeeder::class
        ]);
    }

    /** @test */
    public function can_submit_used_foods_for_user()
    {
        //Arrange
        $user = User::factory()->create();
        $this->actingAs($user);
        $attribute = Food::all(['id'])->random(2)->pluck('id')->toArray();
        //Action
        $response = $this->postJson(route('calorie.submit'), [
            'foods' => $attribute
        ]);
        //Assert
        $response->assertSuccessful();
        $this->assertDatabaseHas('food_user', [
            'user_id' => $user->id,
            'food_id' => $attribute[0]
        ]);
        $this->assertDatabaseHas('food_user', [
            'user_id' => $user->id,
            'food_id' => $attribute[1]
        ]);
    }

    /** @test */
    public function submitting_foods_for_user_requires_authentication()
    {
        //Arrange
        $user = User::factory()->create();
        $attribute = Food::all(['id'])->random(2)->pluck('id')->toArray();
        //Action
        $response = $this->postJson(route('calorie.submit'), [
            'foods' => $attribute
        ]);
        //Assert
        $response->assertUnauthorized();
    }

    /** @test
     * @dataProvider invalidInputs()
     */
    public function submitting_foods_for_user_invalid_inputs_are_detected($foods)
    {
        //Arrange
        $user = User::factory()->create();
        $this->actingAs($user);
        //Action
        $response = $this->postJson(route('calorie.submit'), [
            'foods' => $foods
        ]);
        //Assert
        $response->assertJsonValidationErrorFor('foods', 'result');
    }

    public function invalidInputs(): array
    {
        return [
            'foods not provided' => ['foods', 'foods', null],
            'foods is not array' => ['foods', 'foods', 'invalid input'],
            'foods items are not integer' => ['foods', 'foods', ['invalid input']],
            'foods items are not valid ids' => ['foods', 'foods', [9999, 9998]],
            'foods is empty array' => ['foods', 'foods', []],
        ];
    }
}
