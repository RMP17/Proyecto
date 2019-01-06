<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
	
    protected $table = 'ciudad';
	protected $primaryKey = 'id_ciudad';
	public $timestamps = false;
	
	protected $fillable = [
		'nombre',
		'id_pais',
	];
	
	protected $guarded = [
	
	];
    public function pais(){
        return $this->belongsTo(Pais::class,'id_pais');
    }
    public function suggestionsOfCiudades($query){

        $_suggestionsOfCiudades=[];
        $ciudades = Ciudad::where('nombre', 'like','%'.$query.'%')->orderBy('nombre','desc')->take(10)->get();
        foreach ($ciudades as $ciudad) {
            $_suggestionsOfCiudades[]=[
                'id_ciudad'=>$ciudad->id_ciudad,
                'pais_ciudad'=>$ciudad->pais->nombre.'-'.$ciudad->nombre
            ];
        }
        return $_suggestionsOfCiudades;
    }
}
