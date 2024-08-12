<?php

namespace App\Http\Requests\Staff;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreStaffRequest extends FormRequest
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
            "name" => "required",
            "username" => "required|alpha_dash|unique:users,username",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6",
            "image_path" => "required|image|max:5000|mimes:png,jpg,jpeg,webp,svg",
        ];
    }
}
