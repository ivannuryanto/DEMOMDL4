<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMediaRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', 'unique:media,title'],
            'description' => ['required', 'string'],
            'genre' => ['required', 'string', 'max:255'],
            'episodes' => ['required', 'integer', 'min:1'],
            'release_year' => ['required', 'integer', 'min:1888', 'max:2100'],
            'type' => ['sometimes', 'string', 'max:255'],
        ];
    }
}
