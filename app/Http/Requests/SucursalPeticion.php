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
					'nombre' => 'required|unique:sucursal,nombre|max:50',
					'direccion' =>'required|max:200',
					'telefono' =>'required|max:15',
					'id_ciudad' => 'required',
					'id_empresa' => 'required',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
                    'nombre' => 'required|unique:sucursal,nombre,'.$this->id_sucursal.',id_sucursal|max:50',
                    'direccion' =>'required|max:200',
                    'telefono' =>'required|max:15',
                    'id_ciudad' => 'required',
                    'id_empresa' => 'required',
				];
			}
			default:break;
		}
    }
	
	public function messages()
    {
        return [
            'nombre.required' => 'Debe ingresar el nombre de la sucursal que desea registrar.',
			'nombre.unique' => 'Una sucursal con este nombre ya se encuentra en el registro. Las sucursales no pueden tener el mismo nombre.',
			'direccion.required' => 'Es necesaria la dirección en la que este ubicada la sucursal.',
			'telefono.required' => 'Es necesario registrar un número de contacto de la sucursal.',
			'id_ciudad.required' => 'Elija una ciudad donde se encuentre esta sucursal',
			'id_empresa.required' => 'Elija una empresa a la que esta sucursal pertenece',
        ];
    }
}
