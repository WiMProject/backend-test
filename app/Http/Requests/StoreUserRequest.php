<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|min:10|regex:/^[0-9]+$/',
            'is_active' => 'boolean',
            'department' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Email sudah digunakan.',
            'email.email' => 'Format email tidak valid.',
            'phone.min' => 'Nomor telepon minimal 10 karakter.',
            'phone.regex' => 'Nomor telepon hanya boleh mengandung angka.',
            'name.required' => 'Nama wajib diisi.',
            'department.required' => 'Department wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
        ];
    }
}