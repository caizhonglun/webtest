<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsPost extends FormRequest
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
            'announceStart' => 'required|date|before:announceEnd',
            'announceEnd' => 'required|date',
            'sort' => 'required|in:公告,轉知,維修',
            'title' => 'required|string|max:255',
            'organizer' => 'required|string|max:40',
            'contractor' => 'required|string|max:40',
            'contactPhone' => 'required|string|max:40',
            'attachs.*' => 'file|mimes:pdf,zip|max:20480'
        ];

        return $result;
    }
}
