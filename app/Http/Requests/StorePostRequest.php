<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|min:3|max:255',
            'body'  => 'required|min:10',
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
