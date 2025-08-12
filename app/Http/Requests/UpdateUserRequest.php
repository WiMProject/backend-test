<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $userId = $this->route('user');
        
        return [
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $userId,
            'phone' => 'sometimes|string|min:10|regex:/^[0-9]+$/',
            'is_active' => 'sometimes|boolean',
            'department' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Email sudah digunakan.',
            'email.email' => 'Format email tidak valid.',
            'phone.min' => 'Nomor telepon minimal 10 karakter.',
            'phone.regex' => 'Nomor telepon hanya boleh mengandung angka.',
            'password.min' => 'Password minimal 8 karakter.',
        ];
    }
}