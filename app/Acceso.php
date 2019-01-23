<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Acceso extends Authenticatable
{
    protected $table = 'acceso';
	protected $primaryKey = 'id_empleado';
	public $timestamps = false;
	
	protected $fillable = [
		'usuario',
		'estatus',
	];
    public $incrementing = false;
	
	protected $guarded = [
	    'id_empleado'
	];
    public function permiso(){
        return $this->belongsToMany(Permiso::class,'permiso_usuario', 'id_acceso','id_permiso');
    }
    public function empleado(){
        return $this->hasOne(Empleado::class,'id_empleado','id_empleado');
    }
    public function setPasswordAttribute($value) {
//        $this->attributes['pass'] = Hash::make($value);
        $this->attributes['pass'] = bcrypt($value);
    }
    public function getAuthPassword() {
        return $this->pass;
    }
    public static function newAcceso($parameters_acceso) {
        $_acceso = new Acceso();
        $_acceso->fill($parameters_acceso);
        $_acceso->id_empleado = $parameters_acceso['id_empleado'];
        $_acceso->pass = $parameters_acceso['pass'];
        $_acceso->estatus = 1;
        $_acceso->save();
        $ids=[];
        foreach ($parameters_acceso['permisos_permitidos'] as $permiso) {
            if($permiso['permitir']) {
                array_push($ids,$permiso['id_permiso']);
            }
        }
        $_acceso->permiso()->attach($ids);
        return true;
    }

    public static function updateAcceso($parameters_acceso, $id_empleado) {
        $_acceso = Acceso::findOrFail($id_empleado);
        $_acceso->fill($parameters_acceso);
        if(!empty($parameters_acceso['pass'])) {
            $_acceso->pass = Hash::make($parameters_acceso['pass']);
        }
        $_acceso->update();
        $ids=[];
        foreach ($parameters_acceso['permisos_permitidos'] as $permiso) {
            if($permiso['permitir']) {
                array_push($ids,$permiso['id_permiso']);
            }
        }
        $_acceso->permiso()->sync($ids);
        return true;
    }
}
