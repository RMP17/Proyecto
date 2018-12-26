<?php

namespace Allison\Http\Controllers;

use Illuminate\Http\Request;

class ConversorImagenes extends Controller
{
    public function ImagenABinario($archivo)
	{
		return $encoded_image=base64_encode($archivo);
	}
	
	public function BinarioAImagen($dato)
	{
		return $decoded_image=base64_decode($dato);
	}
}
