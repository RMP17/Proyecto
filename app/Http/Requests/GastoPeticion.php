<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GastoPeticion extends FormRequest
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
            'txtMonto' => 'required',
        ];
    }
	
	public function messages()
	{
		return [
			'txtMonto.required' => 'Debe especificar un monto de gasto.',
		];
	}
}
