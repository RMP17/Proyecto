<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoriaPeticion extends FormRequest
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
					'categoria' => 'required|max:50',
				];
    }
	
	public function messages()
    {
        return [
            'categoria.required' => 'Debe ingresar el nombre de la categoría que desea registrar',
        ];
    }
}
