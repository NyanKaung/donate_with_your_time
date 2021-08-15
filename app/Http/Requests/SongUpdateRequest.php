<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'song_name' => 'nullable|string',
            'song_duration'=> 'nullable|string',
            'song_image'=> 'nullable|string',
            'today_playlist'=> 'nullable|boolean',
            'artist_id'=> 'nullable|numeric',
            'category_id'=> 'nullable|numeric',
            'released_at'=> 'nullable',
        ];
    }
}
