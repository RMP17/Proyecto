<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Empleado extends Model
{
    protected $table = 'empleado';
	protected $primaryKey = 'id_empleado';
	public $timestamps = false;
	
	protected $fillable = [
		'nombre',
		'ci',
		'sexo',
		'fecha_nacimiento',
		'telefono',
		'celular',
		'correo',
		'direccion',
		'foto',
		'persona_referencia',
		'telefono_referencia',
		'fecha_registro',
		'estatus',
		'id_sucursal',
	];
	
	protected $guarded = [
	
	];

    public function sucursal(){
        return $this->belongsTo(Sucursal::class,'id_sucursal');
    }
    public function kardex(){
        return $this->hasMany(Kardex::class,'id_empleado','id_empleado');
    }

    public static function newEmpleado($oarameters){
        // TODO: se debe trabajas aqui
        DB::beginTransaction();
        try {
            $_empleado = new Empleado();
            $_empleado->fill($oarameters);
            $_empleado->fecha_registro = Carbon::now();
            $_empleado->save();

            $kardex = new Kardex;
            $kardex->fill($oarameters->kardex);
            $kardex ->fecha_registro = Carbon::now();
            $kardex->save();

            $salario = new Salario();
            $salario->fill($oarameters->salario);
            $kardex->salario()->save($salario);
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function updateEmpleado($parameters_proveedor, $id_empleado){
        $_empleado = Empleado::findOrFail($id_empleado);
        $_empleado->fill($parameters_proveedor);
        $_empleado->update();
        return true;
    }
    public function getEmpleados(){
        $empleados = Empleado::select('*')->orderBy('nombre','desc')->get();

        foreach ($empleados as $empleado) {
            $kardex = Kardex::where('id_empleado', $empleado->id_empleado)->get();
            $empleado->kardex->observaciones = $kardex->observaciones;

            foreach ($kardex as $_kardex) {
                $salario = $_kardex->salario;
                $_kardex->salario->moneda = Moneda::find($salario->id_moneda)->codigo;
            }
        }

        return $empleados;
    }
}
