<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index(){
        return view('config.index');
    }
}
