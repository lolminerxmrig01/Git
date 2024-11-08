<?php

namespace Modules\Staff\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffCategoryImageRequest extends FormRequest
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
//            'image' => 'required|dimensions:min_width=115,min_height=115',
//            'image' => 'required|image|mimes:jpg|max:2048|dimensions:min_width=115,min_height=115,ratio=1/1',
//            'old_img' => 'nullable',
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
//
        ];
    }

}
