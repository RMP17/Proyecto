<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoPeticion extends FormRequest
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
    protected function prepareForValidation()
    {
        $data = json_decode($this->data, true);
        $this->replace($data);
    }
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
					'nombre' => 'required|max:50',
					'ci' => 'required|unique:empleado,ci|max:15',
					'sexo' =>'max:1',
					'telefono' =>'max:15',
					'celular' =>'max:15',
					'correo' =>'unique:empleado,correo|max:50',
					'direccion' =>'max:200',
					'persona_referencia' =>'max:200',
					'telefono_referencia' =>'max:15',
					'id_sucursal' => 'required',
				];
			}
			case 'PUT':
			case 'PATCH':
			{
				return [
                    'nombre' => 'required|max:50',
                    'ci' => 'required|unique:empleado,ci,'.$this->empleado.',|max:15',
                    'sexo' =>'max:1',
                    'telefono' =>'max:15',
                    'celular' =>'max:15',
                    'correo' =>'unique:empleado,correo,'.$this->empleado.',id_empleado|max:50',
                    'direccion' =>'max:200',
                    'persona_referencia' =>'max:200',
                    'telefono_referencia' =>'max:15',
                    'id_sucursal' => 'required',
				];
			}
			default:break;
		}
    }
	
	public function messages()
    {
        return [
            'nombre.required' => 'Debe ingresar el nombre del empleado que desea registrar.',
			'ci.required' => 'Debe ingresar la cédula de identidad del empleado.',
			'ci.unique' => 'La cédula de identidad ingresada pertenece a otro empleado registrado.',
			'correo.unique' => 'Este correo pertenece a otro empleado registrado.',
			'id_sucursal.required' => 'Elija una sucursal de trabajo para el empleado',
        ];
    }
}
