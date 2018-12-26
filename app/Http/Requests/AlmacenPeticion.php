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
					'txtCodigo' => 'required|unique:almacen,codigo|max:50',
					'txtDireccion' =>'required|max:200',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'txtCodigo' => 'required|unique:almacen,codigo,'.$this->almacen.',id_almacen|max:50',
					'txtDireccion' =>'required|max:200',
				];
			}
			default:break;
		}
    }
	
	public function messages()
    {
        return [
            'txtCodigo.required' => 'Debe ingresar el codigo o identificador del almacen que desea registrar.',
			'txtCodigo.unique' => 'Los almacenes deben tener un identificador o código único dentro del registro.',
			'txtDireccion.required' => 'Es necesaria la dirección en la que este ubicado el almacen.',
        ];
    }
}
