<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CuentaPeticion extends FormRequest
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
                    'txtEntidad' => 'required|max:200',
                    'txtNroCuenta' => 'required|unique:cuenta,nro_cuenta|max:50',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'txtEntidad' => 'required|max:200',
                    'txtNroCuenta' => 'required|max:50',
                ];
            }
            default:break;
        }
    }

     public function messages(){
        return[
            'txtEntidad.required'=>'Debe ingresar el nombre de la Entidad Financiera',
            'txtNroCuenta.unique'=>'Este Nro. de Cuenta ya ha sido registrado',
            'txtNroCuenta.required'=>'Debe ingresar el Nro. de la cuenta ',
        ];
    }
}
