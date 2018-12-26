<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloPeticion extends FormRequest
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
					'txtCodigo' => 'required|unique:articulo,codigo|max:50',
					'txtCodigoBarra' => 'required|max:50',
					'txtPrecioCompra' => 'required',
					'txtPrecioProduccion' => 'required',
					'cbxSubcategoria' => 'required',
					'cbxFabricante' => 'required',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
					'txtNombre' => 'required|max:50',
					'txtCodigo' => 'required|unique:articulo,codigo,'.$this->articulo.',id_articulo|max:50',
					'txtCodigoBarra' => 'required|max:50',
					'txtPrecioCompra' => 'required',
					'txtPrecioProduccion' => 'required',
					'cbxSubcategoria' => 'required',
					'cbxFabricante' => 'required',
				];
			}
			default:break;
		}
    }
	
	public function messages()
    {
        return [
            'txtNombre.required' => 'Debe ingresar el nombre del artículo que desea registrar.',
			'txtCodigo.required' => 'El artículo debe tener un código que lo identifique.',
			'txtCi.unique' => 'Este código pertenece a un artículo registrado.',
			'txtCodigoBarra.required' => 'Debe ingresar el código de barra del producto.',
			'txtPrecioCompra.required' => 'El precio de compra es obligatorio',
			'txtPrecioProduccion.required' => 'El precio de venta de producción en obligatorio',
			'cbxSubcategoria.required' => 'Elija una subcategoría del artículo',
			'cbxFabricante.required' => 'Elija un fabricante para el artículo',
        ];
    }
}
