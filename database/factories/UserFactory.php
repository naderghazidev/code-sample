<?php

namespace Database\Factories;

use App\Enums\ActivityLevel;
use App\Enums\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $bmr = fake()->numberBetween(1000, 3000);
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'email' => fake()->unique()->safeEmail(),
            'weight' => fake()->numberBetween(50, 130),
            'height' => fake()->numberBetween(150, 210),
            'age' => fake()->numberBetween(18, 90),
            'bmr' => $bmr,
            'tdee' => $bmr + fake()->numberBetween(200, 500),
            'password' => 'AbCd1234aBc',
            'gender' => fake()->randomElement([Gender::MALE->value, Gender::FEMALE->value]),
            'activity_level' => fake()->randomElement([
                ActivityLevel::SEDENTARY->value,
                ActivityLevel::LIGHTLY_ACTIVE->value,
                ActivityLevel::MODERATELY_ACTIVE->value,
                ActivityLevel::VERY_ACTIVE->value,
                ActivityLevel::EXTREMELY_ACTIVE->value,
            ])
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
