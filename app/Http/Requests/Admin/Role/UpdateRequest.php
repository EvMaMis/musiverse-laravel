<?php

namespace App\Http\Requests\Admin\Artist;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'name' => ['string', 'required', Rule::unique('artists', 'name')->ignore($this->id)],
            'description' => 'string|required',
        ];
    }

    public function messages() : array {
        return [
            'name.string' => 'Заполните поле названия',
            'name.required' => 'Заполните поле названия',
            'name.unique' => 'Такой исполнитель уже существует',
            'description.string' => 'Заполните поле описания',
            'description.required' => 'Заполните поле описания'
        ];
    }
}
