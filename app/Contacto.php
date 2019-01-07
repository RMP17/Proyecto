<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Contacto extends Model
{
    protected $table = 'contacto';
	protected $primaryKey = 'id_contacto';
	public $timestamps = false;
	
	protected $fillable = [
		'nombre',
		'telefono',
		'interno',
		'celular',
		'correo',
		'id_proveedor',
		'id_cargo'
	];
	
	protected $guarded = [
	
	];

    public function proveedor(){
        return $this->belongsTo(Proveedor::class,'id_proveedor');
    }

    public static function newContacto($parameters_contacto){
        $_contacto = new Contacto();
        $_contacto->fill($parameters_contacto);
        $_contacto->fecha_registro = Carbon::now();
        $_contacto->save();
        return true;
    }
}
