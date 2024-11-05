<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'release_date' => 'required|date',
            'publishing_house' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'author.required' => 'The author field is required.',
            'author.string' => 'The author must be a string.',
            'author.max' => 'The author may not be greater than 255 characters.',
            'release_date.required' => 'The release date field is required.',
            'release_date.date' => 'The release date must be a valid date.',
            'publishing_house.required' => 'The publishing house field is required.',
            'publishing_house.string' => 'The publishing house must be a string.',
            'publishing_house.max' => 'The publishing house may not be greater than 255 characters.',
        ];
    }
}
