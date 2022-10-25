<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ExplodeRequest extends FormRequest
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
            "name"       => ["required","min:1","max:50"],
            "place"      => ["required"],
            "speed"      => ["required"],
            "quantity"   => ["required"],
            "size"       => ["required"],
            "front_bigger" => ["required"],
        ];
    }

    public function attributes()
    {
        return [
            'name'      => 'タイトル',
            'place'     => '粒子発生場所',
            'speed'     => '粒子速度',
            'quantity'  => '粒子量',
            'size'      => '粒子サイズ',
            'colors'    => '粒子色',
            'front_bigger' => '前方拡大',
        ];
    }
}
