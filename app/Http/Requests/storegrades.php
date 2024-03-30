<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// 58:00 video 5
class storegrades extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        // 2:32 video 9
        return [
            'Name'=>'required|unique:grades,name->ar,'.$this->id,
            'Name_en'=>'required|unique:grades,name->en,'.$this->id,
        ];
    }
    public function messages()
    {
        return [
            'Name.required' => trans('validation.required'),
            'Name.unique' => trans('validation.unique'),
            'Name_en.required' => trans('validation.required'),
            'Name_en.unique' => trans('validation.unique'),
        ];
    }
}
