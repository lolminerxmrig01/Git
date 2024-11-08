<?php

namespace Modules\Staff\Brand\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffBrandRequest extends FormRequest
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
            'name' => 'required',
            'en_name' => 'required',
//            'en_name' => 'required|unique:brands,en_name',
            'description' => 'nullable',
            'categories' => 'required',
            'slug' => 'required',
            'type' => 'nullable',
            'image' => 'nullable',
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
          'name.required' => 'وارد کردن نام برند اجباری است',
          'en_name.required' => 'وارد کردن نام لاتین برند اجباری است',
          'en_name.unique' => 'نام لاتین برند تکراری است',
          'slug.required' => 'وارد کردن نامک برند اجباری است',
        ];
    }

}
