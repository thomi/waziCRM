<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Validation\Rules;
use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'username' => ['required', 'string', 'max:24', 'unique:'.User::class],
            'full_name' => ['required', 'string', 'max:255'],
            'email_address' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone_number' => ['required', 'string', 'max:255', 'unique:'.User::class], //'regex:/^07\d{8}$/'
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
