<?php

namespace App\Http\Requests\Admin\User;

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
            'name' => 'string|required',
            'email' => ['string', 'required', Rule::unique('users', 'email')->ignore($this->id)],
            'role' => 'string|required',
        ];
    }

    public function messages() : array {
        return [
            'name' => 'Заполните поле названия',
            'email.unique' => 'Эта почта уже используется',
            'email' => 'Заполните поле электронной почты',
            'role' => 'Заполните поле роли пользователя',
        ];
    }
}
