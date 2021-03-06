<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CajaPeticion extends FormRequest
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
            'nombre' => 'required|max:50',
			'id_empleado' => 'required',
        ];
    }
	
	public function messages()
    {
        return [

        ];
    }
}
