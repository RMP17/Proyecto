<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CargoPeticion extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  true;
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
                    'txtNombre' => 'required|unique:cargo,nombre|max:50',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'txtNombre' => 'required|unique:cargo,nombre,'.$this->cargo.',id_cargo|max:50',
                ];
            }
            default:break;
        }
    }
    public function messages()
    {
        return [
            'txtNombre.required' => 'Debe ingresar el nombre del cargo que desea registrar',
            'txtNombre.unique' => 'El nombre del cargo ya existe en el registro',
        ];
    }
}
