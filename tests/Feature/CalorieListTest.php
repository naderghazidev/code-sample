<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\CaloriesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CalorieListTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed([
            CaloriesSeeder::class
        ]);
    }

    /** @test */
    public function can_get_list_of_foods_and_their_calories()
    {
        //Arrange
        $user = User::factory()->create();
        $this->actingAs($user);
        //Action
        $response = $this->getJson(route('calorie.index'));
        //Assert
        $response->assertSuccessful();
        $response->assertJsonStructure([
            'success',
            'message',
            'result' => [
                '*' => [
                    'id',
                    'name',
                    'calorie'
                ]
            ]
        ]);
    }

    /** @test */
    public function getting_list_of_calories_requires_authentication()
    {
        //Arrange

        //Action
        $response = $this->getJson(route('calorie.index'));
        //Assert
        $response->assertUnauthorized();
    }
}
