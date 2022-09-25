<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\CaloriesSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CalorieSubmissionTest extends TestCase
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
    public function can_submit_used_calorie()
    {
        //Arrange
        $user = User::factory()->create();
        $this->actingAs($user);
        //Action
//        $response=$this->postJson(route('calorie.submit'),[])
        //Assert

    }
}
