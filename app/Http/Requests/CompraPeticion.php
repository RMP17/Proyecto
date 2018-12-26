<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompraPeticion extends FormRequest
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
                    
                    /*'cbxMoneda' => 'required',
                    'cbxEmpleado' => 'required',
                    'cbxContacto' => 'required'*/
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                   /* 'cbxMoneda' => 'required',
                    'cbxEmpleado' => 'required',
                    'cbxContacto' => 'required'*/
                ];
            }
            default:break;
        }
    }
    
    public function messages()
    {
        return [
            
            /*'cbxMoneda.required' => 'Elija la moneda',
            'txtCosto.required' => 'Los campos de costo son abligatorios',
            'cbxEmpleado.required' => 'Elija el empleado',
            'cbxContacto.required' => 'Elija el ccontacto'*/
        ];
    }
}
