<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VentaRequest extends FormRequest
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
                        'id_moneda' => 'required',
                        'detalles_venta' => 'required',
                        'tipo_pago' => 'required'
                    ];
                    foreach ($this->get('detalles_venta') as $key => $val) {
                        $rules['detalles_venta.'.$key.'.id_articulo'] = 'required';
                        $rules['detalles_venta.'.$key.'.precio_unitario'] = 'required|min:1';
                        $rules['detalles_venta.'.$key.'.cantidad'] = 'required|:min:1';
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
            default:{
                return [];
            }
        }
    }
}
