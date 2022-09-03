<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class AdminRequest extends FormRequest
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
        Validator::extend('without_spaces', function($attr, $value){
            return preg_match('/^\S*$/u', $value);
        });
        return [
            'username' => 'required|unique:admins',
            'password' => 'required|min:8',
        ];
    }

    public function messages()
    {
        return [
            'username.required' => 'Username perlu diisi.',
            'username.without_spaces' => 'Username tidak boleh spasi',
            'username.unique' => 'Username sudah ada.',
            'password.required' => 'Password perlu diisi.',
            'password.min' => 'Minimal 8 Karakter.',
        ];
    }
}
