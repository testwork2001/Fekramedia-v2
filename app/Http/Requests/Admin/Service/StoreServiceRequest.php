<?php

namespace App\Http\Requests\Admin\Service;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
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
            'service.name'=>['required' , 'string' , 'between:5,255' ],
            'service.status'=>['required' , 'in:1,0'],
            'service.details'=>['required' , 'string' , 'between:1,1000'],
            'service.icon'=>['required' , 'string'],
            'image'=>['required' , 'max:1024' ],
            'service.category_id'=>['required' , 'integer' , 'exists:categories,id'],
            'processes.*.name'=>['required' , 'string' , 'between:5,255'],
            'processes.*.status'=>['required' , 'in:1,0'],
            'processes.*.icon'=>['required' , 'string' , 'starts_with:<i' , 'ends_with:</i>' , 'max:255'],
            'processes.*.details'=>['required' , 'string' , 'between:20,1000'],
            'processes.*.image'=>['required'  , 'max:1024' ]

        ];
    }
}
