<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMediaRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['sometimes', 'required', 'string', 'max:255', Rule::unique('media', 'title')->ignore($this->route('media'))],
            'description' => ['sometimes', 'required', 'string'],
            'genre' => ['sometimes', 'required', 'string', 'max:255'],
            'episodes' => ['sometimes', 'required', 'integer', 'min:1'],
            'release_year' => ['sometimes', 'required', 'integer', 'min:1888', 'max:2100'],
            'type' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
