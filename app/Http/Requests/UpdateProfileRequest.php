<?php

namespace App\Http\Requests;

use App\Rules\ValidExistingPassword;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
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
            'existing_password' => ['required_with:new_password', new ValidExistingPassword()],
            'new_password' => 'sometimes|min:3',
            'confirm_password' => 'sometimes|same:new_password',
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
            'confirm_password.same' => 'password ไม่ตรงกัน',
            'new_password.min' => 'password ไม่ครบ',
        ];
    }
}
