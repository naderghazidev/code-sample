<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class LoginTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function can_login_user_by_email_and_password()
    {
        //Arrange
        $password = 'AbCd1234aBc';
        $user = User::factory()->create([
            'password' => $password,
        ]);
        //Action
        $response = $this->postJson(route('user.login'), [
            'email' => $user->email,
            'password' => $password,
        ]);
        //Assert
        $response->assertSuccessful();
        $this->assertAuthenticatedAs($user);
    }

    /** @test
     * @dataProvider invalidInputs()
     */
    public function logging_user_in_invalid_inputs_are_detected($field, $errorKey, $invalidValue)
    {
        //Arrange
        $password = 'AbCd1234aBc';
        $user = User::factory()->create([
            'password' => Hash::make($password),
        ]);
        $attributes = [
            'email' => $user->email,
            'password' => $password,
        ];
        $attributes[$field] = $invalidValue;
        //Action
        $response = $this->postJson(route('user.login'), $attributes);
        //Assert
        $response->assertJsonValidationErrorFor($errorKey, 'result');
    }

    public function invalidInputs(): array
    {
        return [
            'email not provided' => ['email', 'email', null],
            'email is not valid' => ['email', 'email', 123],

            'password not provided' => ['password', 'password', null],
        ];
    }
}
