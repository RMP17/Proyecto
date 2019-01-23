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
                $rules = [
                    'fecha' => 'required',
                    'id_moneda' => 'required',
                    'detalles_compra' => 'required',
                    'tipo_pago' => 'required'
                ];
                foreach ($this->request->get('detalles_compra') as $key => $val) {
                    $rules['detalles_compra.'.$key.'.id_almacen'] = 'required';
                }
                return $rules;
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
            'detalles_compra.*.required' => 'El almacen es requerido'
            
            /*'cbxMoneda.required' => 'Elija la moneda',
            'txtCosto.required' => 'Los campos de costo son abligatorios',
            'cbxEmpleado.required' => 'Elija el empleado',
            'cbxContacto.required' => 'Elija el ccontacto'*/
        ];
    }
}
