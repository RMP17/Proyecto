<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('permiso_panel_adm', ['only' => ['index']]);
    }
    public function index(){
        return view('config.index');
    }
}
