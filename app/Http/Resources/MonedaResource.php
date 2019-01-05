<?php

namespace Allison\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class MonedaResource extends Resource
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
            'id_moneda' => $this->id_moneda,
            'nombre' => $this->nombre,
            'codigo' => $this->codigo,
            'pais' => $this->pais,
        ];
    }
}
