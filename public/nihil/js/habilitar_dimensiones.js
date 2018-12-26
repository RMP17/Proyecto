function habilitar_dimensiones(valor)
{
	if(valor)
	{
		document.getElementById("txtLargo").disabled = false;
		document.getElementById("txtAncho").disabled = false;
		document.getElementById("txtEspesor").disabled = false;
		document.getElementById("txtVolumen").disabled = false;
	}
	else
	{
		document.getElementById("txtLargo").disabled = true;
		document.getElementById("txtAncho").disabled = true;
		document.getElementById("txtEspesor").disabled = true;
		document.getElementById("txtVolumen").disabled = true;
		document.getElementById("txtLargo").value = "";
		document.getElementById("txtAncho").value = "";
		document.getElementById("txtEspesor").value = "";
		document.getElementById("txtVolumen").value = "";
	}
};