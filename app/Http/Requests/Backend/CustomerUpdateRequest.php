<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class CustomerUpdateRequest extends FormRequest
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
            'name'             => 'required|max:255',
            'email'            => ['required', 'email', Rule::unique('users', 'email')->ignore($this->customer)],
            'username'         => ['required', 'min:5', Rule::unique('users', 'username')->ignore($this->customer)],
            'phone'            => ['required', Rule::unique('users', 'phone')->ignore($this->customer)],
            'password'         => 'nullable|min:6',
            'password_confirm' => 'nullable|same:password'
        ];
    }
}
