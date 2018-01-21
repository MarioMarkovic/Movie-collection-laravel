<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
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
            'title'     => 'required|min:2|max:191', 
            'genre_id'  => 'required', 
            'year'      => 'required|digits:4', 
            'duration'  => 'required|min:2|max:1440|numeric',
            'image'     => 'required|image|max:1999'
        ];    
    }
}
