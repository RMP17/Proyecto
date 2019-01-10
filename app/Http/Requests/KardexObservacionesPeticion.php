<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KardexObservacionesPeticion extends FormRequest
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
        switch ($this->method()) {
            case 'GET':

            case 'DELETE':
                {
                    return [];
                }
            case 'POST':
                {
                    return [
                        'id_kardex' => 'required',
                        'observacion' => 'required|max:50',
                    ];

                }
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'id_kardex' => 'required',
                        'observacion' => 'required|max:50',
                    ];
                }
            default:
                {
                    return [];
                }
        }
    }

    public function messages()
    {
        return [
            'id_kardex.required' => 'ID de Kardex es requerido',
            'observacion.required' => 'El campo de observación es requerido.',
            //'observacion.max' => 'El campo de observación excede el numero caracteres permitidos.',
        ];
    }
}
