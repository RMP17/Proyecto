<?php

namespace Allison\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProveedorResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id_proveedor' => $this->id_proveedor,
            'razon_social' => $this->razon_social,
            'nit' => $this->nit,
            'telefono' => $this->telefono,
            'fax' => $this->fax,
            'celular' => $this->celular,
            'correo' => $this->correo,
            'sitio_web' => $this->sitio_web,
            'direccion' => $this->direccion,
            'fecha_registro' => $this->fecha_registro,
            'rubro' => $this->rubro,
            'ciudad' => $this->ciudad,
            'cuentasProveedor' => $this->cuentasProveedor,
        ];
    }
}
