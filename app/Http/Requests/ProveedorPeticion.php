<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProveedorPeticion extends FormRequest
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
                    'razon_social' => 'required|max:50',
                    'nit' => 'required|unique:proveedor,nit|max:15',
                    'telefono' =>'max:15',
                    'fax'=>'max:15',
                    'celular' =>'max:15',
                    'correo' =>'unique:proveedor,correo|max:50',
                    'sitio_web' =>'max:50',
                    'direccion' =>'max:200',
                    'id_ciudad' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'razon_social' => 'required|max:50',
                    'nit' => 'required|unique:proveedor,nit,'.$this->id_proveedor.',id_proveedor',
                    'telefono' =>'max:15',
                    'fax' =>'max:15',
                    'celular' =>'max:15',
                    'correo' => 'unique:proveedor,correo,'.$this->id_proveedor.',id_proveedor',
                    'sitio_web' =>'max:50',
                    'direccion' =>'max:200',
                    'id_ciudad' => 'required',
                ];
            }
            default:break;
        }
    }
   
    public function messages()
    {
        return [
            'razon_social.required' => 'Debe ingresar la Razón Social del Proveedor que desea registrar.',
            'nit.required' => 'Debe ingresar el NIT del proveedor.',
            'nit.unique' => 'El NIT ingresado pertenece a otro proveedor registrado.',
            'correo.unique' => 'Este correo pertenece a otro proveedor registrado.',
            'id_ciudad.required' => 'Elija una ciudad para el proveedor',
        ];
    }
 }
    
