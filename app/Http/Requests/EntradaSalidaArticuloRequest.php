<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EntradaSalidaArticuloRequest extends FormRequest
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
                        'id_almacen'=> 'required',
                        'id_articulo'=> 'required',
                        'actividad'=> 'required',
                        'cantidad'=> 'required|numeric|min:1',
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
