<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CajaChicaPeticion extends FormRequest
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
                return [
					'txtMontoDeclarado' => 'required',
				];
            }
            case 'POST':
            {
                return [
                    'cbxEmpleado' => 'required',
                    'cbxSucursal' => 'required',
                    'txtMontoApertura' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'cbxEmpleado' => 'required',
                    'cbxSucursal' => 'required',
					'txtMontoApertura' => 'required',
                ];
            }
            default:break;
        }
    }
    public function messages(){
        return[
            'cbxEmpleado.required'=>'Seleccione el empleado encargado de la caja chica.',
            'cbxSucursal.required'=>'Seleccione la sucursal a la que esta caja pertenece.',
            'txtMontoApertura.required'=>'Debe ingresar el monto de apertura de la caja chica.',
			'txtMontoDeclarado.required'=>'Debe registrar el monto real existente en caja chica'
        ];
    }
}
