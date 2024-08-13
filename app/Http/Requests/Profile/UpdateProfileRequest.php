<?php

namespace App\Http\Requests\Profile;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    
    // Mengembalikan array aturan validasi untuk request ini
    public function rules(): array
    {
        return [
            // Aturan untuk field "name": wajib diisi
            "name" => "required",
            // Aturan untuk field "username": wajib diisi, hanya boleh mengandung huruf, angka, strip, dan garis bawah
            "username" => "required|alpha_dash",
            // Aturan untuk field "email": wajib diisi, harus berformat email, dan harus unik di tabel "users" pada kolom "email"
            "email" => "required|email|unique:users,email," . auth()->id(),
            // Aturan untuk field "password": wajib diisi dan minimal memiliki 6 karakter
            "password" => "nullable|min:6",
            "image_path" => "nullable|image|max:5000|mimes:png,jpg,jpeg,webp,svg",
        ];
    }
}
