<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:255' . $this->route('post'),
            'body'  => 'required|min:10',
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
        ];
    }
}
