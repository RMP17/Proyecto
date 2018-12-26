<?php

namespace Allison\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
                    'txtRazonSocial' => 'required|max:50',
                    'txtNit' => 'required|unique:proveedor,nit|max:15',
                    'txtTelefono' =>'max:15',
                    'fax'=>'max:15',
                    'txtCelular' =>'max:15',
                    'txtCorreo' =>'unique:proveedor,correo|max:50',
                    'txtSitioWeb' =>'max:50',
                    'txtDireccion' =>'max:200',
                    'cbxCiudad' => 'required',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'txtRazonSocial' => 'required|max:50',
                    'txtNit' => 'required|unique:proveedor,nit,'.$this->proveedor.',id_proveedor|max:15',
                    'txtTelefono' =>'max:15',
                    'txtCelular' =>'max:15',
                    'txtCorreo' =>'unique:proveedor,correo,'.$this->proveedor.',id_proveedor|max:50',
                    'txtSitioWeb' =>'max:50',
                    'txtDireccion' =>'max:200',
                    'cbxCiudad' => 'required',
                ];
            }
            default:break;
        }
    }
   
    public function messages()
    {
        return [
            'txtRazonSocial.required' => 'Debe ingresar la Razón Social del Proveedor que desea registrar.',
            'txtNit.required' => 'Debe ingresar el NIT del proveedor.',
            'txtNit.unique' => 'El NIT ingresado pertenece a otro proveedor registrado.',
            'txtCorreo.unique' => 'Este correo pertenece a otro proveedor registrado.',
            'cbxCiudad.required' => 'Elija una ciudad para el proveedor',
        ];
    }
 }
    
