<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'song_name' => 'required|string',
            'song_duration'=> 'required|string',
            'song_image'=> 'required|string',
            'today_playlist'=> 'required|boolean',
            'artist_id'=> 'required|numeric',
            'category_id'=> 'required|numeric',
            'released_at'=> 'required',
        ];
    }
}
