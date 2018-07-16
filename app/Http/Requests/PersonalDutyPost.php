<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonalDutyPost extends FormRequest
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
            'name' => 'bail|required|max:60',
            'position' => 'max:13',
            'telephone' => 'required|max:13',
            'telephone_extension' => 'max:9',
            'direct_telephone' => 'max:13',
            'fax' => 'max:13',
            'email' => 'max:255',
            'agent' => 'max:255',
            'thumbnail' => 'image|max:20480',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'thumbnail.required' => '請選擇您要上傳的跑馬燈圖片。'
        ];
    }
}
