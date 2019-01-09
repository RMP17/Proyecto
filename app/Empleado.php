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
        DB::beginTransaction();
        try {
            $data = json_decode($oarameters->data, true);
            $urlImage = null;
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
            $_empleado->status = 1;
            $_empleado->save();

            $kardex = new Kardex;
            $kardex->fill($data['kardex']);
            $kardex ->fecha_registro = Carbon::now();
            $_empleado->kardex()->save($kardex);

            $salario = new Salario();
            $salario->fill($data['kardex']['salario']);
            $kardex->salario()->save($salario);
            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }

    public function updateEmpleado($parameters_empleado, $id_empleado){
        //TODO: Te quedaste aqui
        DB::beginTransaction();
        try {
            $data = json_decode($parameters_empleado->data, true);
            $urlImage = null;
            $path = public_path().'/images';
            if (count($peticion->allFiles()) > 0 ) {
                if (!is_null($articulo->imagen)) {
                    $_temPath = $path.$articulo->imagen;
                    if (File::exists($_temPath)) {
                        File::delete($_temPath);
                    }
                }
                $files = $peticion->allFiles();
                $validator2 = Validator::make($files, [
                    'imagen' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);
                if ($validator2->fails()) {
                    return response()->json($validator2->errors(), 400);
                };
                $imageTempName = $files['imagen']->getPathname();
                $imageName = $files['imagen']->getClientOriginalName();
                $files['imagen']->move($path, now()->timestamp.$imageName);
                $urlImage = now()->timestamp.$imageName;
            }
            $_empleado = Empleado::findOrFail($id_empleado);
            $_empleado->fill($data);
            $_empleado->fecha_registro = Carbon::now();
            $_empleado->foto = $urlImage;
            $_empleado->status = 1;
            $_empleado->update();

            $kardex = new Kardex;
            $kardex->fill($data['kardex']);
            $kardex ->fecha_registro = Carbon::now();
            $_empleado->kardex()->save($kardex);

            $salario = new Salario();
            $salario->fill($data['kardex']['salario']);
            $kardex->salario()->save($salario);
            DB::commit();
            return true;

        } catch (\Exception $e) {
            DB::rollBack();
            return false;
        }
    }
    public static function getEmpleados(){
        $empleados = Empleado::select('*')->orderBy('nombre','desc')->get();

        foreach ($empleados as $empleado) {
            $kardex = Kardex::where('id_empleado', $empleado->id_empleado)->orderBy('id_kardex','desc')->first();
            $kardex->kardexObservaciones;
            $salario = $kardex->salario;
            if(!is_null($salario)) {
                $kardex->salario->moneda = Moneda::find($salario->id_moneda)->codigo;
            } else {
                $kardex->salario = null;
            }

            $empleado->sucursal;
            $empleado->kardex = $kardex;
            $empleado->edad = $empleado->edad();
        }

        return $empleados;
    }
}
