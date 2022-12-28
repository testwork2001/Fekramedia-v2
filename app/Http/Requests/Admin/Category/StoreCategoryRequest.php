<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'name'=>['required' , 'string' , 'unique:categories' , 'between:5,255'],
            'icon'=>['required' , 'string' , 'starts_with:<i' , 'ends_with:</i>' , 'max:255'],
            'status'=>['required' , 'digits:1' , 'in:0,1'],
            'details'=>['required' , 'string' ,'between:10,500']
        ];
    }
}
