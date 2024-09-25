<?php

namespace App\Http\Requests\RoomChecker;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRoomCheckerRequest extends FormRequest
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
            "date" => "required",
            "time" => "required",
            "status" => "nullable",
            "room_id" => "nullable",
            "description" => "required",
            "image" => "nullable|file|image|max:5048|mimes:png,jpg,jpeg,webp,svg",
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            back()->with('error', $validator->errors())
        );
    }
}