<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //false=บังคับ Login
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
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
            'name.required' => 'ชื่อสกุล ห้ามว่าง',
            'email.required' => 'email ห้ามว่าง',
            'email.email' => 'รูปแบบ email ไม่ถูกต้อง',
            'email.unique' => 'email ซ้ำ',
            'password.required' => 'password ห้ามว่าง',
            'password.min' => 'password ไม่ครบ',
        ];
    }
}
