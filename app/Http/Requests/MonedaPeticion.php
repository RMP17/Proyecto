<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MonedaPeticion extends FormRequest
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
			'txtNombre' => 'required|max:50',
			'txtCodigo' => 'required|max:16',
			'cbxPais' => 'required',
		];
   
    }
	
	public function messages()
    {
        return [
            'txtNombre.required' => 'El nombre de la moneda que desea registrar es obligatorio',
			'txtCodigo.required' => 'El codigo de la moneda es obligatorio',
			'cbxPais.required' => 'Elija a que país pertenece esta moneda',
        ];
    }
}

