<?php

namespace App\Http\Requests\Admin\Genre;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'title' => 'string|required|unique:genres'
        ];
    }

    public function messages() : array {
        return [
            'title.unique' => 'The title has already been taken',
            'title' => 'This field can\'t be empty',
        ];
    }
}
