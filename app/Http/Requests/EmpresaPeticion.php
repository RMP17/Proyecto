<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaPeticion extends FormRequest
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
                    'txtRazon_social' => 'required|max:200',
                    'txtNit' => 'required|unique:empresa,nit|max:15',
                    'txtPropietario' => 'required|max:50',
                    'txtActividad' => 'max:200',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'txtRazon_social' => 'required|max:200',
                    'txtNit' => 'required|unique:empresa,nit,'.$this->empresa.',id_empresa|max:15',
                    'txtPropietario' => 'required|max:50',
                    'txtActividad' => 'max:200',
                ];
            }
            default:break;
        }
    }
    public function messages(){
        return[
            'txtRazon_social.required'=>'Debe ingresar la Razón Social',
            'txtRazon_social.unique'=>'La razón social de la empresa ya existe en el registro',
            'txtNit.required'=>'Debe ingresar el NIT de la empresa',
            'txtNit.unique'=>'El NIT de la empresa ya existe en el registro',
			'txtPropietario'=>'Es necesario conocer el nombre del propietario de la empresa',
        ];
    }
}
