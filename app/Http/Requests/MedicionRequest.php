<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MedicionRequest extends FormRequest
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
                        'fecha_visita'=> 'required|date_format:Y-m-d H:i:s',
                        'direccion'=> 'required',
                        'descripcion_direccion'=> 'required',
                        'id_cliente'=> 'required',
                        'detalles' => 'required',
                    ];
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
