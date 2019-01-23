<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactoPeticion extends FormRequest
{    /**
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
                    'nombre' => 'required|max:200',
                    'telefono' =>'max:15',
                    'celular' =>'max:15',
                    'correo' =>'nullable|unique:contacto,correo|max:50',
                    'id_proveedor' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'nombre' => 'required|max:200',
                    'telefono' =>'max:15',
                    'celular' =>'max:15',
                    'correo' =>'nullable|unique:contacto,correo,'.$this->id_contacto.',id_contacto|max:50',
                    'id_proveedor' => 'required',
                ];
            }
            default:break;
        }
    }
   
    public function messages()
    {
        return [
            'nombre.required' => 'Debe ingresar el nombre del contacto que desea registrar.',
            'correo.unique' => 'Este correo pertenece a otro contacto registrado.',
			'proveedor.required' => 'Elija un proveedor para el contacto',
            'ciudad.required' => 'Elija una ciudad para el contacto',
        ];
    }
}
