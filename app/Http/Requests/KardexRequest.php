<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KardexRequest extends FormRequest
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
                        'fecha_inicio' => 'required|date_format:Y-m-d',
                        'id_cargo' => 'required',
                        'id_empleado' => 'required',
                        'salario' => 'required|numeric|min:0',
                    ];

                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'id_kardex' => 'required',
                        'fecha_inicio' => 'required|date_format:Y-m-d',
                        'id_cargo' => 'required',
                        'id_empleado' => 'required',
                        'salario' => 'required|numeric|min:0',
                    ];
                }
            default:break;
        }
    }
}
