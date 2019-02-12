<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovimientoAlmacenRequest extends FormRequest
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
                        'id_almacen_origen' => 'required',
                        'id_almacen_destino' => 'required',
                        'detalles' => 'required'
                    ];
                    return $rules;
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [];
                }
            default:{
                return [];
            }
        }
    }
}
