<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DutyPost extends FormRequest
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
            'sort_id' => 'required|integer',
            'name' => 'required|max:255',
            'name1' => 'required|max:255',
            'name2' => 'required|max:255',
            'engName' => 'required|regex:/^[\pL\s-_\']+$/|max:255',
            'duty' => 'required'
        ];
    }
}
