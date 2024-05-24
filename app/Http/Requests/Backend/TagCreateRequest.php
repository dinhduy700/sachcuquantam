<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

class TagCreateRequest extends FormRequest
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
            $validate[$lang.'.tag_name'] = 'required|max:255';
            $validate[$lang.'.tag_slug'] = 'nullable|unique:tag_translation,tag_slug';
        }
        $validate['position'] = 'required|numeric';

        return $validate;
    }
}
