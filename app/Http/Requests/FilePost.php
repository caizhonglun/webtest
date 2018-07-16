<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilePost extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'attachs.*' => 'file|mimes:pdf,zip|max:10240'
        ];

        return $result;
    }
}
