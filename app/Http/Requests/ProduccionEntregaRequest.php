<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProduccionEntregaRequest extends FormRequest
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
                        'id_produccion' => 'required',
                        'id_empleado' => 'required',
                        'id_articulo' => 'required',
                        'cantidad' => 'required|numeric',
                    ];
                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'nombre' => 'required|unique:cargo,nombre',
                    ];
                }
            default:break;
        }
    }
}
