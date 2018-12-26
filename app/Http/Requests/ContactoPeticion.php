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
                    'txtNombre' => 'required|max:200',
                    'txtTelefono' =>'max:15',
                    'txtCelular' =>'max:15',
                    'txtCorreo' =>'unique:contacto,correo|max:50',
                    'cbxProveedor' => 'required',
                    'cbxCargo' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'txtNombre' => 'required|max:200',
                    'txtTelefono' =>'max:15',
                    'txtCelular' =>'max:15',
                    'txtCorreo' =>'unique:contacto,correo,'.$this->contacto.',id_contacto|max:50',
                    'cbxProveedor' => 'required',
                    'cbxCargo' => 'required',
                ];
            }
            default:break;
        }
    }
   
    public function messages()
    {
        return [
            'txtNombre.required' => 'Debe ingresar el nombre del contacto que desea registrar.',
            'txtCorreo.unique' => 'Este correo pertenece a otro contacto registrado.',
			'cbxProveedor.required' => 'Elija un proveedor para el contacto',
            'cbxCiudad.required' => 'Elija una ciudad para el contacto',
        ];
    }
}
