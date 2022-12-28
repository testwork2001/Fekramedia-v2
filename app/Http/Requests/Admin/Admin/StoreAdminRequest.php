<?php

namespace App\Http\Requests\Admin\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'between:5,255'],
            'email' => ['required', 'unique:admins',  'string', 'email'],
            'phone' => ['required', 'string', 'unique:admins', 'digits:11', 'starts_with:0'],
            'status' => ['required', 'digits:1', 'in:0,1,2'],
            'email_verified_at' => ['required', 'digits:1', 'in:0,1'],
            'password' => ['required', 'string', 'regex:"^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
            ', 'confirmed'],
            'password_confirmation' => ['required'],
            'image'=>['nullable' , 'file' , 'max:1024']
        ];
    }
}
