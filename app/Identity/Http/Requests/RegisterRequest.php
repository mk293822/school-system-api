<?php

namespace App\Identity\Http\Requests;

use App\Identity\Application\DTOS\RegisterUserData;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Password;

class RegisterRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'phone_number' => ['required', 'string', 'max:255', 'unique:users,phone_number'],
            'password' => ['required', 'string', 'min:8', 'confirmed', Password::defaults()],
            'profile_photo_path' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function toDto(): RegisterUserData
    {
        return new RegisterUserData(
            name: $this->input('name'),
            email: $this->input('email'),
            phone_number: $this->input('phone_number'),
            profile_photo_path: $this->input('profile_photo_path'),
            password: $this->input('password'),
        );
    }
}
