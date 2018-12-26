<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrecioPeticion extends FormRequest
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
					'txtPrecio1' => 'required',
					'txtPrecio2' => 'required',
					'txtPrecio3' => 'required',
					'txtPrecio4' => 'required',
					'txtPrecio5' => 'required',
					'cbxArticulo' => 'required',
					'cbxSucursal' =>'required',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'txtPrecio1' => 'required',
					'txtPrecio2' => 'required',
					'txtPrecio3' => 'required',
					'txtPrecio4' => 'required',
					'txtPrecio5' => 'required',
				];
			}
			default:break;
		}
    }
	
	public function messages()
    {
        return [
            'txtPrecio1.required' => 'PRECIO 1 : Todos los precios son requeridos, si desea registrar menos precios agregue los demas con valor 0.',
			'txtPrecio2.required' => 'PRECIO 2 :Todos los precios son requeridos, si desea registrar menos precios agregue los demas con valor 0.',
			'txtPrecio3.required' => 'PRECIO 3 :Todos los precios son requeridos, si desea registrar menos precios agregue los demas con valor 0.',
			'txtPrecio4.required' => 'PRECIO 4 :Todos los precios son requeridos, si desea registrar menos precios agregue los demas con valor 0.',
			'txtPrecio5.required' => 'PRECIO 5 :Todos los precios son requeridos, si desea registrar menos precios agregue los demas con valor 0.',
			'cbxArticulo.required' => 'El artículo al que pertenecen los precios es necesario.',
			'cbxSucursal.required' => 'Es necesaría la sucursal a la que estos precios pertenecen',
        ];
    }
}
