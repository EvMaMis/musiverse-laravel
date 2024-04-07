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
            'name' => 'string|required|unique:artists',
            'description' => 'string|required',
        ];
    }

    public function messages() : array {
        return [
            'name.string' => 'Заполните поле названия',
            'name.required' => 'Заполните поле названия',
            'name.unique' => 'Такой исполнитель уже существует',
            'description.string' => 'Заполните поле описания',
            'description.required' => 'Это поле обязательно к заполнению'
        ];
    }
}
