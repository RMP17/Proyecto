<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SucursalPeticion extends FormRequest
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
					'txtNombre' => 'required|unique:sucursal,nombre|max:50',
					'txtDireccion' =>'required|max:200',
					'txtTelefono' =>'required|max:15',
					'cbxCiudad' => 'required',
					'cbxEmpresa' => 'required',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'txtNombre' => 'required|unique:sucursal,nombre,'.$this->sucursal.',id_sucursal|max:50',
					'txtDireccion' =>'required|max:200',
					'txtTelefono' =>'required|max:15',
					'cbxCiudad' => 'required',
				];
			}
			default:break;
		}
    }
	
	public function messages()
    {
        return [
            'txtNombre.required' => 'Debe ingresar el nombre de la sucursal que desea registrar.',
			'txtNombre.unique' => 'Una sucursal con este nombre ya se encuentra en el registro. Las sucursales no pueden tener el mismo nombre.',
			'txtDireccion.required' => 'Es necesaria la dirección en la que este ubicada la sucursal.',
			'txtTelefono.required' => 'Es necesario registrar un número de contacto de la sucursal.',
			'cbxCiudad.required' => 'Elija una ciudad donde se encuentre esta sucursal',
			'cbxEmpresa.required' => 'Elija una empresa a la que esta sucursal pertenece',
        ];
    }
}
