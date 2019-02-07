<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class CortesControlador extends Controller
{
  public function __construct()
	{
		
	}
	
	public function index()
	{
        return view('cortes.index');
	}
}
