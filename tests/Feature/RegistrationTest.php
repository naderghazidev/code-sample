<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegistrationTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function can_register_a_new_user()
    {
        //Arrange
        $password = 'AbCd1234aBc';
        $attributes = User::factory()->raw([
            'password' => $password,
            'password_confirmation' => $password
        ]);
        //Action
        $response = $this->postJson(route('user.register'), $attributes);
        //Assert
        $response->assertSuccessful();
        $this->assertDatabaseHas('users', collect($attributes)->except(['password', 'password_confirmation','bmr','tdee'])->all());
    }

    /** @test
     * @dataProvider invalidInputs()
     */
    public function registering_a_user_invalid_inputs_are_detected($field, $errorKey, $invalidValue)
    {
        //Arrange
        $password = 'AbCd1234aBc';
        $attributes = User::factory()->raw([
            'password' => $password,
            'password_confirmation' => $password
        ]);
        $attributes[$field] = $invalidValue;
        //Action
        $response = $this->postJson(route('user.register'), $attributes);
        //Assert
        $response->assertJsonValidationErrorFor($errorKey, 'result');
        $this->assertDatabaseMissing('users', collect($attributes)->except(['password', 'password_confirmation'])->all());
    }

    public function invalidInputs(): array
    {
        return [
            'first_name not provided' => ['first_name', 'first_name', null],
            'first_name is not string' => ['first_name', 'first_name', 12312],
            'first_name is too short' => ['first_name', 'first_name', 'a'],

            'last_name not provided' => ['last_name', 'last_name', null],
            'last_name is not string' => ['last_name', 'last_name', 12312],
            'last_name is too short' => ['last_name', 'last_name', 'a'],

            'email not provided' => ['email', 'email', null],
            'email is not valid' => ['email', 'email', 123],

            'password not provided' => ['password', 'password', null],
            'password too short' => ['password', 'password', '123jn'],

            'password_confirmation does not match' => ['password_confirmation', 'password', 'AbCd1234aBd'],

            'weight not provided' => ['weight', 'weight', null],
            'weight is not a number' => ['weight', 'weight', 'ads'],

            'height not provided' => ['height', 'height', null],
            'height is not a number' => ['height', 'height', 'ads'],

            'age not provided' => ['age', 'age', null],
            'age is not a number' => ['age', 'age', 'ads'],

            'gender not provided' => ['gender', 'gender', null],
            'gender not string' => ['gender', 'gender', 123123],
            'gender is invalid' => ['gender', 'gender', 'ads'],

        ];
    }
}
