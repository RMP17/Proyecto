<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CuentaProveedorPeticion extends FormRequest
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
                    'entidad' => 'required|max:200',
                    'nro_cuenta' => 'required|unique:cuenta,nro_cuenta|max:50'
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'entidad' => 'required|max:200',
                    'nro_cuenta' => 'required|unique:cuenta,nro_cuenta|max:50'
                ];
            }
            default:break;
        }
    }

     public function messages(){
        return[
            'entidad.required'=>'Debe ingresar el nombre de la Entidad Financiera',
            'nro_cuenta.unique'=>'Este Nro. de Cuenta ya ha sido registrado',
            'nro_cuenta.required'=>'Debe ingresar el Nro. de la cuenta ',
        ];
    }
}
