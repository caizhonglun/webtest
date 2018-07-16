<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class MarqueePost extends FormRequest
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
            'title' => 'required|string|max:255',
            'organizer' => 'required|string|max:40',
            'phone' => 'required|max:40|max:20480'
        ];

        // 判斷是新增還是更新
        $currentAction = Route::getCurrentRoute()->getActionName();

        list(, $act) = explode('@', $currentAction);

        if ($act === 'update') {
            $result['thumbnail'] = 'image|dimensions:max_width=130,max_height=55';
        } else {
            $result['thumbnail'] = 'required|image|dimensions:max_width=130,max_height=55';
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
            'organizer.required' => '申請單位 必須填寫。',
            'dimensions' => '圖片尺寸不對，請修改為寬度最寬為130px、高度最高為55px。'
        ];
    }
}
