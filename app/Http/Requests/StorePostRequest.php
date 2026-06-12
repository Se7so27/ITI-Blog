<?php

namespace App\Http\Requests;

use App\Rules\MaxPosts;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3', 'max:255', new MaxPosts],
            'body'  => 'required|min:10',
            'image' => 'nullable|mimes:jpg,png|max:2048',
            'tags'  => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The post title is required.',
            'title.min'      => 'Title must be at least 3 characters.',
            'title.max'      => 'Title may not exceed 255 characters.',
            'body.required'  => 'The post body is required.',
            'body.min'       => 'Body must be at least 10 characters.',
            'image.mimes'    => 'Image must be a JPG or PNG file.',
            'image.max'      => 'Image must not exceed 2MB.',
        ];
    }
}
