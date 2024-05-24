<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class NewsUpdateRequest extends FormRequest
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
            $validate[$lang.'.news_title'] = 'required|max:255';
            $validate[$lang.'.seo_title']  = 'nullable|max:255';
            $validate[$lang.'.news_slug']  = ['nullable',Rule::unique('news_translation', 'news_slug')->ignore($this->news, 'news_id')];
        }
        $validate['news_position'] = 'required|numeric';

        return $validate;
    }
}
