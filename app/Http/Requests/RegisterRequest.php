<?php

namespace App\Http\Requests;

use App\Enums\ActivityLevel;
use App\Enums\Gender;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'email' => 'required|email',
            'password' => ['required', Password::min(8), 'confirmed'],
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'age' => 'required|numeric',
            'gender' => 'required|string|in:' . Gender::MALE->value . ',' . Gender::FEMALE->value,
            'activity_level' => 'required|string|in:'
                . ActivityLevel::SEDENTARY->value . ','
                . ActivityLevel::LIGHTLY_ACTIVE->value . ','
                . ActivityLevel::MODERATELY_ACTIVE->value . ','
                . ActivityLevel::VERY_ACTIVE->value . ','
                . ActivityLevel::EXTREMELY_ACTIVE->value
        ];
    }
}
