<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;

class MovimientosAlmacenController extends Controller
{
    public function index()
    {
        return view('movimientos_almacen.index');
    }
}
