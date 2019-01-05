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
                    'nombre' => 'required|unique:cargo,nombre|max:50',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'nombre' => 'required|unique:cargo,nombre',
                ];
            }
            default:break;
        }
    }
    public function messages()
    {
        return [
            'nombre.required' => 'Debe ingresar el nombre del cargo que desea registrar',
            'nombre.unique' => 'El nombre del cargo ya existe en el registro',
        ];
    }
}
