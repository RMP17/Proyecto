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
			'nombre' => 'required|max:50',
			'codigo' => 'required|max:16',
			'id_pais' => 'required',
		];
   
    }
	
	public function messages()
    {
        return [
            'nombre.required' => 'El nombre de la moneda que desea registrar es obligatorio',
			'codigo.required' => 'El codigo de la moneda es obligatorio',
			'pais.required' => 'Elija a que país pertenece esta moneda',
        ];
    }
}

