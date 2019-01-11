<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Acceso extends Model
{
    protected $table = 'acceso';
	protected $primaryKey = 'id_empleado';
	public $timestamps = false;
	
	protected $fillable = [
		'usuario',
		'pass',
		'estatus',
	];
	
	protected $guarded = [
	
	];
    public function permiso(){
        return $this->belongsToMany(Permiso::class,'permiso_usuario', 'id_permiso');
    }
    public function setPassAttribute($value) {
//        $this->attributes['pass'] = Hash::make($value);
        $this->attributes['pass'] = bcrypt($value);
    }
    public static function newAcceso($parameters_acceso) {
        $_acceso = new Acceso();
        $_acceso->fill($parameters_acceso);
        $_acceso->id_empleado = $parameters_acceso['id_empleado'];
        $_acceso->save();

        $ids=[];
        // FIXME: corrige este campo
        foreach ($parameters_acceso['permisos_permitidos'] as $permiso) {
            if($permiso['permitir']) {
                array_push($ids,$permiso['id_permiso']);
            }
        }
        $_acceso->permiso()->sync($ids);
        return true;
    }
}
