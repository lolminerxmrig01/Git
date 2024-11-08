<?php

namespace Modules\Staff\Category\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaffCategoryRequest extends FormRequest
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
          'slug' => 'required',
          'en_name' => 'required',
          'image' => 'required',
        ];
    }
}
