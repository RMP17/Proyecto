<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoPeticion extends FormRequest
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
		switch($this->method())
		{
			case 'GET':
			case 'DELETE':
			{
				return [];
			}
			case 'POST':
			{
				return [
					'txtNombre' => 'required|max:50',
					'txtCi' => 'required|unique:empleado,ci|max:15',
					'rbtSexo' =>'max:1',
					'txtTelefono' =>'max:15',
					'txtCelular' =>'max:15',
					'txtCorreo' =>'unique:empleado,correo|max:50',
					'txtDireccion' =>'max:200',
					'txtPersonaReferencia' =>'max:200',
					'txtTelefonoReferencia' =>'max:15',
					'cbxSucursal' => 'required',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'txtNombre' => 'required|max:50',
					'txtCi' => 'required|unique:empleado,ci,'.$this->empleado.',id_empleado|max:15',
					'rbtSexo' =>'max:1',
					'txtTelefono' =>'max:15',
					'txtCelular' =>'max:15',
					'txtCorreo' =>'unique:empleado,correo,'.$this->empleado.',id_empleado|max:50',
					'txtDireccion' =>'max:200',
					'txtPersonaReferencia' =>'max:200',
					'txtTelefonoReferencia' =>'max:15',
					'cbxSucursal' => 'required',
				];
			}
			default:break;
		}
    }
	
	public function messages()
    {
        return [
            'txtNombre.required' => 'Debe ingresar el nombre del empleado que desea registrar.',
			'txtCi.required' => 'Debe ingresar la cédula de identidad del empleado.',
			'txtCi.unique' => 'La cédula de identidad ingresada pertenece a otro empleado registrado.',
			'txtCorreo.unique' => 'Este correo pertenece a otro empleado registrado.',
			'cbxSucursal.required' => 'Elija una sucursal de trabajo para el empleado',
        ];
    }
}
