<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;

class MedicionController extends Controller
{
    public function index(){
        return view('mediciones.index');
    }
}
