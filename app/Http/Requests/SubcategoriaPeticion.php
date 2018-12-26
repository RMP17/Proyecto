<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubcategoriaPeticion extends FormRequest
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
					'txtSubcategoria' => 'required|max:50',
					'txtIdCategoria' => 'required',
				];
    }
	
	public function messages()
    {
        return [
            'txtSubcategoria.required' => 'Debe ingresar el nombre de la subcategoría que desea registrar',
			'txtIdCategoria.required' => 'Error de referencia con la categoría',
        ];
    }
}
