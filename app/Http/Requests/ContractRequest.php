<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
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
            'name'=>'required|min:4',
            'date'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'name.*'=>'El nombre es requerido',
            'date.*'=>'La fecha es requerida'
        ];
    }
}
