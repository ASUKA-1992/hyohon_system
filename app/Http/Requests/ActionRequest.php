<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActionRequest extends FormRequest
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
            "name"      => ["required","min:1","max:50",Rule::unique('actions')->ignore($this->id)],
            "name_sub"  => ["required"],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'アクション名',
            'name_sub' => 'アクション区分',
            'active_flg' => '有効フラグ',
        ];
    }

    public function messages() {
        return [
            'name.required' => ':attributeは必須項目です。',
            'name.max' => ':attributeは20字以下で入力してください。',
        ];
    }
}
