<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LinkPost extends FormRequest
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
        $result = [
            'url' => 'required|url',
            'title' => 'required|string|max:40',
            'organizer' => 'required|string|max:40',
            'contactPhone' => 'required|max:40',
        ];
        return $result;
    }
}
