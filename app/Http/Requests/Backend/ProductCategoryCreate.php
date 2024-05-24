<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryCreate extends FormRequest
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
        $validate = [];

        foreach (config('constants.multilang') as $lang) {
            $validate[$lang.'.product_category_name'] = 'required|max:255';
            $validate[$lang.'.seo_title']             = 'nullable|max:255';
            $validate[$lang.'.product_category_slug'] = 'nullable|unique:product_category_translation,product_category_slug';
        }
        $validate['parent_id'] = 'nullable|numeric';

        return $validate;
    }
}
