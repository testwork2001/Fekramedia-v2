<?php

namespace App\Http\Requests\Admin\Price;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePricerRequest extends FormRequest
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
            'name' => ['required', 'string', "unique:pricing,name,{$this->id},id"],
            'price' => ['required', 'numeric', 'min:1'],
            'status' => ['required', 'in:1,0'],
            'icon' => ['required', 'string', 'starts_with:<i class=', 'ends_with:</i>'],
            'features' => ['required', 'array'],
            'features.*' => ['required', 'string'],
        ];
    }
}
