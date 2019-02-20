<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduccionRequest extends FormRequest
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
                        'detalles' => 'required',
                        'tipo_pago' => 'required',
                        'fecha_inicio' => 'required',
                        'fecha_entrega' => 'required',
                    ];
                    foreach ($this->get('detalles') as $key => $val) {
                        $rules['detalles.'.$key.'.id_articulo'] = 'required';
                        $rules['detalles.'.$key.'.precio_unitario'] = 'required|min:1';
                        $rules['detalles.'.$key.'.cantidad'] = 'required|:min:1';
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
