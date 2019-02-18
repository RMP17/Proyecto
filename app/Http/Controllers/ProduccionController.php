<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;

class ProduccionController extends Controller
{
    public function index(){

        return view('produccion.index');
    }
}
