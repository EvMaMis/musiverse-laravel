<?php

namespace App\Http\Requests\Admin\Playlist;

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
            'title' => 'string|required',
            'artist_id' => 'integer|required',
            'genre_id' => 'integer|required|exists:genres,id',
            'cover' => 'nullable|mimes:png,jpg,jpeg',
            'file' => 'nullable|mimes:mp3,wav,ogg',
            'tags' => 'nullable|array',
            'tags.*' => 'nullable|integer|exists:tags,id',
        ];
    }

    public function messages() : array {
        return [
            'title' => 'Поле названия должно быть заполнено',
            'artist_id' => 'Необходимо выбрать исполнителя',
            'genre_id' => 'Необходимо выбрать жанр',
            'cover.required' => 'Введите путь к обложке',
            'cover.mimes' => 'Файл должен иметь одно из разрешений: png, jpg, jpeg',
            'file.required' => 'Необходимо выбрать файл композиции',
            'file.mimes' => 'Файл должен иметь одно из разрешений: mp3, wav, ogg',
        ];
    }
}
