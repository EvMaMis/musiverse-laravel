<?php

namespace App\Http\Requests\Admin\Playlist;

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
            'cover' => 'required|mimes:png,jpg,jpeg',
            'playlist_songs' => 'required',
            'user_id' => 'required',
        ];
    }

    public function messages() : array {
        return [
            'title' => 'Поле названия должно быть заполнено',
            'cover.required' => 'Введите путь к обложке',
            'cover.mimes' => 'Файл должен иметь одно из разрешений: png, jpg, jpeg',
            'playlist_songs.required' => 'Add songs to playlist'
        ];
    }
}
