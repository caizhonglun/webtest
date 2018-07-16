<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class CarouselPost extends FormRequest
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
            'phone' => 'required|max:40',
        ];

        // 判斷是新增還是更新
        $currentAction = Route::getCurrentRoute()->getActionName();

        list(, $act) = explode('@', $currentAction);

        if ($act === 'update') {

            $result['thumbnail'] = 'image|dimensions:max_width=600|max:20480';
        } else {
            $result['thumbnail'] = 'required|image|dimensions:max_width=600|max:20480';

        }

        return $result;
    }
}
