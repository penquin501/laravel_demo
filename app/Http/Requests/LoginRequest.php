<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:3'
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
            'email.required' => 'email ห้ามว่าง',
            'email.email' => 'รูปแบบ email ไม่ถูกต้อง',
            'password.required' => 'password ห้ามว่าง',
            'password.min' => 'password ไม่ครบ',
        ];
    }
}
