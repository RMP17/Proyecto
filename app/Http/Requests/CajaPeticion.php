<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CajaPeticion extends FormRequest
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
			'cbxEmpleado' => 'required',
			'cbxSucursal' => 'required',
        ];
    }
	
	public function messages()
    {
        return [
            'txtNombre.required' => 'Debe ingresar el nombre de la ciudad que desea registrar',
			'cbxEmpleado.required' => 'Debe elegir un empleado que controle esta caja',
			'cbxSucursal.required' => 'Debe elegir una sucursal en la que esta caja funcione',
        ];
    }
}
