<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class storeClassroom extends FormRequest
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
        return [
            // 12:43 video 9
            // 16:48 video 9
            // array validation
            'List_Classes.*.Name' => 'required',
            'List_Classes.*.Name_class_en' => 'required',


        ];
    }
    public function messages()
    {
        return [
            'Name.required' => trans('validation.required'),
            'Name_class_en.required' => trans('validation.required')
        ];
    }
}
