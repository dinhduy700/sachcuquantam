<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;

use Illuminate\Validation\ValidationException;

class BannerCreate extends FormRequest
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
            $validate[$lang.'.banner_image'] = 'required|max:255';
            $validate[$lang.'.banner_title'] = 'required|max:255';
            $validate[$lang.'.banner_link'] = 'nullable|url';
        }
        // $validate['banner_position'] = 'required|numeric';
        return $validate; 
    }
}
