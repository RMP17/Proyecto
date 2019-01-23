<?php

namespace Allison\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class SimpleSuggestionsEmpleadosResource extends Resource
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
            'id_empleado' => $this->id_empleado,
            'nombre' => $this->nombre
        ];
    }
}
