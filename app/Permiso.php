<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permiso';
    protected $primaryKey = 'id_permiso';
    public $timestamps = false;

    protected $fillable = [
        'descripcion',
    ];

    protected $guarded = [

    ];
    public function acceso(){
        return $this->belongsToMany(Acceso::class,'permiso_usuario', 'usuario');
    }

    public static function getPermisos(){
        $permisos = Permiso::select()->orderBy('descripcion', 'desc')->get();
        return $permisos;
    }
}
