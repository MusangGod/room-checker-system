<?php

namespace App\Http\Requests\Post;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdatePostRequest extends FormRequest
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
            // Aturan untuk field "title": wajib diisi dan harus unik di tabel "posts" pada kolom "title"
            "title" => "required|unique:posts,title," . $this->post->id,
            // Aturan untuk field "content": wajib diisi dan minimal memiliki 15 karakter
            "content" => "required|min:15",
            // Aturan untuk field "status": wajib diisi dan hanya boleh bernilai "draft" atau "published"
            "status" => "required|in:draft,published",
            // Aturan untuk field "tag_ids": wajib diisi dan harus berupa array
            "tag_ids" => "required|array",
            // Aturan untuk setiap elemen dalam array "tag_ids": wajib diisi dan harus berupa integer
            "tag_ids.*" => "required|integer",
            // Aturan untuk field "image_path": harus berupa gambar, maximal size 5000mb dan format harus png,jpg,jpeg,webp atau gif
            "image_path" => "nullable|image|max:5000|mimes:png,jpg,jpeg,webp,svg",
        ];
    }
}
