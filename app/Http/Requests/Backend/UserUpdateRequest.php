<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
            'email'            => ['required', 'email', Rule::unique('users', 'email')->ignore($this->user)],
            'username'         => ['required', 'min:5', Rule::unique('users', 'username')->ignore($this->user)],
            'password'         => 'nullable|min:6',
            'password_confirm' => 'nullable|same:password'
        ];
    }
}
