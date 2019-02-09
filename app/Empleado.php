<?php

namespace Allison;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
		'id_almacen',
	];
    protected $attributes = [
        'nombre'=> null,
        'ci'=> null,
        // Sexo trabaja con estos valores:
        // f=femenino; m=masculino;
        'sexo'=> null,
        'fecha_nacimiento'=> null,
        'telefono'=> null,
        'celular'=> null,
        'correo'=> null,
        'direccion'=> null,
        'foto'=> null,
        'persona_referencia'=> null,
        'telefono_referencia'=> null,
        'id_almacen'=> null,
    ];
	
	protected $guarded = [
        'estatus'
    ];

    public function almacen(){
        return $this->belongsTo(Almacen::class,'id_almacen')->withDefault([
            'id_almacen'=>null,
            'codigo'=>null,
            'direccion'=>null,
            'id_sucursal'=>null,
        ]);
    }
    public function kardex(){
        return $this->hasMany(Kardex::class,'id_empleado','id_empleado');
    }
    public function acceso(){
        return $this->hasOne(Acceso::class,'id_empleado','id_empleado');
    }
    protected function edad()
    {
        $edad=0;
        if(!is_null($this->fecha_nacimiento))
        {
            $values=preg_split("[\/|-]",$this->fecha_nacimiento);
            $d=$values[2];
            $m=$values[1];
            $Y=$values[0];
            // Fecha inicio
            $values2=preg_split("[\/|-]", Carbon::now()->toDateString() );
            $i_d=$values2[2];
            $i_m=$values2[1];
            $i_Y=$values2[0];
            $edad=($i_m.$i_d < $m.$d) ? $i_Y-$Y-1 : $i_Y-$Y;
        }
        return $edad;
    }

    public static function newEmpleado($oarameters){
       /* DB::beginTransaction();
        try {*/
            $data = json_decode($oarameters->data, true);
            $urlImage = '';
            $path = public_path().'/images';
            if (count($oarameters->allFiles()) > 0) {
                $files = $oarameters->allFiles();
                $imageTempName = $files['foto']->getPathname();
                $imageName = $files['foto']->getClientOriginalName();
                $files['foto']->move($path, now()->timestamp.$imageName);
                $urlImage = now()->timestamp.$imageName;
            }
            $_empleado = new Empleado();
            $_empleado->fill($data);
            $_empleado->fecha_registro = Carbon::now();
            $_empleado->foto = $urlImage;
            $_empleado->estatus = 1;
            $_empleado->save();

            $kardex = new Kardex;
            $kardex->fill($data['kardex']);
            $kardex ->fecha_registro = Carbon::now();
            $_empleado->kardex()->save($kardex);

            $salario = new Salario();
            $salario->fill($data['kardex']['salario']);
            $kardex->salario()->save($salario);
            /*DB::commit();*/

        /*} catch (\Exception $e) {
            DB::rollBack();
            return false;
        }*/
    }
    public static function updateEmpleado($parameters_empleado, $id_empleado){
        DB::beginTransaction();
        try {
            $data = json_decode($parameters_empleado->data, true);
            $urlImage = null;
            $_empleado = Empleado::findOrFail($id_empleado);
            $path = public_path().'/images/';
            if (count($parameters_empleado->allFiles()) > 0 ) {
                if (!is_null($parameters_empleado->foto)) {
                    $_temPath = $path.$_empleado->foto;
                    if (File::exists($_temPath)) {
                        File::delete($_temPath);
                    }
                }
                $files = $parameters_empleado->allFiles();
                $imageTempName = $files['foto']->getPathname();
                $imageName = $files['foto']->getClientOriginalName();
                $files['foto']->move($path, now()->timestamp.$imageName);
                $urlImage = now()->timestamp.$imageName;
                $_empleado->foto = $urlImage;
            }

            $_empleado->fill($data);
            $_empleado->update();

            $kardex = Kardex::find($data['kardex']['id_kardex']);
            $kardex->fill($data['kardex']);
            $kardex->update();

            $salario = Salario::find($data['kardex']['id_kardex']);
            $salario->fill($data['kardex']['salario']);
            $salario->update();
            Bitacora::insertInBitacora('UPDATE', $_empleado);
            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
    public static function getEmpleados(){
        $empleados = Empleado::select('*')->orderBy('nombre','asc')->get();
        foreach ($empleados as $empleado) {
            $kardex = Kardex::where('id_empleado', $empleado->id_empleado)->orderBy('id_kardex','desc')->first();
            if(!is_null($kardex)){
                $kardex->kardexObservaciones;
                $salario = $kardex->salario;
                if(!is_null($salario)) {
                    $kardex->salario->moneda = Moneda::find($salario->id_moneda)->codigo;
                } else {
                    $kardex->salario = null;
                }
                $empleado->kardex = $kardex;

            }
            $empleado->almacen;
            $empleado->edad = $empleado->edad();
        }

        return $empleados;
    }
    public static function simpleSuggestionsEmpleado($query){
        $empleados = Empleado::where('nombre', 'like','%'.$query.'%')->orderBy('nombre','desc')->take(10)->get();

        return $empleados;
    }
    public function changeStatus(){
        $this->estatus= $this->estatus==1 ? 0:1;
        $acceso = Acceso::find($this->id_empleado);
        $acceso->estatus = $acceso->estatus==1 ? 0:1;
        $acceso->update();
        $this->update();
    }
}
