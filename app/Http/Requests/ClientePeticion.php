<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientePeticion extends FormRequest
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
                    'txtRazonSocial' => 'required|max:200',
                    'txtNit' => 'required|unique:cliente,nit|max:15',
                    'txtActividad' => 'max:200',
                    'txtTelefono' => 'max:15',
                    'txtCelular' => 'max:15',
                    'txtCorreo' => 'max:50',
                    'txtDireccion' => 'max:200',
                    'cbxCiudad' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'txtRazonSocial' => 'required|max:200',
                    'txtNit' => 'required|unique:cliente,nit,'.$this->cliente.',id_cliente|max:15',
                    'txtActividad' => 'max:200',
                    'txtTelefono' => 'max:15',
                    'txtCelular' => 'max:15',
                    'txtCorreo' => 'max:50',
                    'txtDireccion' => 'max:200',
                    'cbxCiudad' => 'required',
                ];
            }
            default:break;
        }
    }
    public function messages(){
        return[
            'txtRazonSocial.required'=>'Se necesita lamrazón social o el nombre del cliente para registrarlo',
            'txtNit.required'=>'Se necesita el NIT o cédula de identidad del cliente',
            'txtNit.unique'=>'El identificador de NIT o cédula de ientidad ya está registrado',
            'cbxCiudad.required'=> 'Elija la ciudad donde reside el cliente',
        ];
    }
}
