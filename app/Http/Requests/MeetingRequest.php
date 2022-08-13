<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MeetingRequest extends FormRequest
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
            "title"      => ["required","min:1","max:50"],
            "owner"      => ["required","min:1","max:10"],
            "tag"        => ["max:100"],
        ];
    }

    public function attributes()
    {
        return [
            'name'  => config("const.label.meeting_name"),
            'title' => config("const.label.meeting_title"),
            'owner' => config("const.label.owner"),
            'tag'   => config("const.label.tag"),
        ];
    }
}
