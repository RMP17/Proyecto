<?php

namespace Allison\Http\Controllers;

use Allison\Http\Requests\MedicionRequest;
use Allison\Medicion;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MedicionController extends Controller
{
    public function index(){
        return view('mediciones.index');
    }
    public function store(MedicionRequest $request){
        Medicion::newMedicion($request->all());
        return response()->json();
    }
    public function destroy($id_medicion){
        Medicion::find($id_medicion)->delete();
        return response()->json();
    }
    public function getMedicionByRangeDate(Request $request)
    {
        $dates = ['date_start' => $request['date1'], 'date_end'=> $request['date2']];
        $validator = validator()->make($dates, [
            'date_start' => ['required', 'date_format:Y-m-d'],
            'date_end' => ['required', 'date_format:Y-m-d'],
        ]);
        $d1 = Carbon::parse($dates['date_start']);
        $d2 = Carbon::parse($dates['date_end']);
        if ($d1 > $d2) {
            return response()->json(['errors' => 'Fecha de inicio debe ser menor o igual a la fecha final'],400);
        }
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $mediciones = Medicion::getMedicionesByRangeDate($dates['date_start'], $dates['date_end']);
        return response()->json($mediciones);
    }

}
