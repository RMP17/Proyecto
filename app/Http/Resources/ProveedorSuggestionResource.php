<?php

namespace Allison\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class ProveedorSuggestionResource extends Resource
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
        ];
    }
}
