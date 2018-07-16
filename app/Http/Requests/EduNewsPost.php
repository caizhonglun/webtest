<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class EduNewsPost extends FormRequest
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
            'activityStart' => 'required|date|before_or_equal:activityEnd',
            'activityEnd' => 'required|date',
            'title' => 'required|string|max:255',
            'content' => 'required',
            'organizer' => 'required|string|max:40',
            'contractor' => 'required|string|max:40',
            'contactPhone' => 'required|string|max:40',
        ];

        // 判斷是新增還是更新
        $currentAction = Route::getCurrentRoute()->getActionName();

        list(, $act) = explode('@', $currentAction);

        if ($act === 'update') {
            $result['themeImg'] = 'image';
        } else {
            $result['themeImg'] = 'required|image';
        }

        return $result;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'themeImg.required' => '請選擇您的標題圖片。'
        ];
    }

}
