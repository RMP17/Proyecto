<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoEmpleadoPeticion extends FormRequest
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
            'txtTipo' => 'required|max:200',
        ];
    }
	
	public function messages()
    {
        return [
            'txtTipo.required' => 'El tipo de empleado debe tener un nombre.',
        ];
    }
}
