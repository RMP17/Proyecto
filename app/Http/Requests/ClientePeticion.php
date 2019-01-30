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
                    'razon_social' => 'required|max:200',
                    'nit' => 'required|unique:cliente,nit|max:15|min:4',
                    'actividad' => 'max:200',
                    'telefono' => 'max:15',
                    'celular' => 'max:15',
                    'correo' => 'max:50',
                    'direccion' => 'max:200',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'razonSocial' => 'required|max:200',
                    'nit' => 'required|unique:cliente,nit|max:15',
                    'actividad' => 'max:200',
                    'telefono' => 'max:15',
                    'celular' => 'max:15',
                    'correo' => 'max:50',
                    'direccion' => 'max:200',
                ];
            }
            default:break;
        }
    }
    public function messages(){
        return[

        ];
    }
}
