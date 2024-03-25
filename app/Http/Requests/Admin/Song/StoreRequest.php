<?php

namespace App\Http\Requests\Admin\Artist;

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
            'title' => 'string|required',
            'artist_id' => 'integer|required',
            'image' => 'string|required',
            'file' => 'string|required',
        ];
    }

    public function messages() : array {
        return [
            'required' => 'Поле :attribute должно быть заполнено',
        ];
    }
}