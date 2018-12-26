<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CiudadPeticion extends FormRequest
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
			'txtIdPais' => 'required',
        ];
    }
	
	public function messages()
    {
        return [
            'txtNombre.required' => 'Debe ingresar el nombre de la ciudad que desea registrar',
			'txtIdPais.required' => 'Error de referencia con el país',
        ];
    }
}
