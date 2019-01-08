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
                    'razon_social' => 'required|max:200',
                    'nit' => 'required|unique:empresa,nit|max:15',
                    'propietario' => 'required|max:50',
                    'actividad' => 'max:200',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'razon_social' => 'required|max:200',
                    'nit' => 'required|unique:empresa,nit,'.$this->empresa.',id_empresa|max:15',
                    'propietario' => 'required|max:50',
                    'actividad' => 'max:200',
                ];
            }
            default:break;
        }
    }
    public function messages(){
        return[
            'razon_social.required'=>'Debe ingresar la Razón Social',
            'razon_social.unique'=>'La razón social de la empresa ya existe en el registro',
            'nit.required'=>'Debe ingresar el NIT de la empresa',
            'nit.unique'=>'El NIT de la empresa ya existe en el registro',
			'propietario'=>'Es necesario conocer el nombre del propietario de la empresa',
        ];
    }
}
