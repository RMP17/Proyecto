<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlmacenPeticion extends FormRequest
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
					'codigo' => 'required|unique:almacen,codigo|max:50',
					'direccion' =>'required|max:200',
					'id_proveedor' =>'required',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
                    'codigo' => 'required|unique:almacen,codigo,'.$this->id_almacen.',id_almacen|max:50',
                    'direccion' =>'required|max:200',
                    'id_proveedor' =>'required',
				];
			}
			default:break;
		}
    }
	
	public function messages()
    {
        return [
            'codigo.required' => 'Debe ingresar el codigo o identificador del almacen que desea registrar.',
			'codigo.unique' => 'Los almacenes deben tener un identificador o código único dentro del registro.',
			'direccion.required' => 'Es necesaria la dirección en la que este ubicado el almacen.',
			'id_proveedor.required' => 'El proveedor es requerido',
        ];
    }
}
