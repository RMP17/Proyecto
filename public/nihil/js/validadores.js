function ValidarNumeroTecleado(event) 
{
    if((event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 35 || event.charCode == 43)) return true;
     return false;        
};

function ValidarNumeroPegado(event, id)
{
	var texto = document.getElementById(id).value;
	for (i=0; i<=texto.length; i++)
	{
		caracter = texto.charCodeAt(i);
		if(caracter < 48 || caracter > 57)
		{
		if (caracter == 35 || caracter == 43) continue;
			document.getElementById(id).value = "";
			return;
		}
	}
};

function ValidarDecimalTecleado(event, id) 
{
	if(event.charCode == 46)
	{
		var texto = document.getElementById(id).value;
		if (texto.length == 0) return false;
		var cont = 0;
		for (i=0; i<=texto.length; i++)
		{
			caracter = texto.charCodeAt(i);
			if (caracter == 46) cont ++;
		}
		return (cont <= 0)? true : false;
	}
    if(event.charCode >= 48 && event.charCode <= 57) return true;
    return false;        
};

function ValidarDecimalPegado(event, id)
{
	var texto = document.getElementById(id).value;
	var cont = 0;
	for (i=0; i<=texto.length; i++)
	{
		caracter = texto.charCodeAt(i);
		if(caracter == 46)
		{	
			if (i == 0)
			{
				document.getElementById(id).value = "";
				return;
			}
			cont++;
			if (cont > 1)
			{
				document.getElementById(id).value = "";
				return;
			}
		}
		else
		{
			if(caracter < 48 || caracter > 57)
			{
				document.getElementById(id).value = "";
				return;
			}
		}
	}
};

function ValidarCorreo(event, id)
{
	var texto = document.getElementById(id).value;
	var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if (texto == "")
	{
		document.getElementById("msmCorreo").innerText = "";
		document.getElementById("msmCorreo").className = "col-sm-4 text-right control-label col-form-label";
		document.getElementById("lblCorreo").className = "col-sm-3 text-right control-label col-form-label";
		document.getElementById(id).className = "form-control";
		return;
	}
	if(regex.test(texto))
	{
		document.getElementById("msmCorreo").innerText = "Formato de correo aceptado";
		document.getElementById("msmCorreo").className = "col-sm-4 text-right control-label text-success";
		document.getElementById("lblCorreo").className = "col-sm-3 text-right control-label text-success";
		document.getElementById(id).className = "form-control is-valid";
	}
	else
	{
		document.getElementById("msmCorreo").innerText = "Formato de correo erróneo";
		document.getElementById("msmCorreo").className = "col-sm-4 text-right control-label text-danger";
		document.getElementById("lblCorreo").className = "col-sm-3 text-right control-label text-danger";
		document.getElementById(id).className = "form-control is-invalid";
		document.getElementById(id).focus();
	}
};

function ValidarSitioWeb(event, id)
{
	var texto = document.getElementById(id).value;
	var regex = /^(http|https)\:\/\/[a-z0-9\.-]+\.[a-z]{2,4}/gi;
	if (texto == "")
	{
		document.getElementById("msmSitioWeb").innerText = "";
		document.getElementById("msmSitioWeb").className = "col-sm-4 text-right control-label col-form-label";
		document.getElementById("lblSitioWeb").className = "col-sm-3 text-right control-label col-form-label";
		document.getElementById(id).className = "form-control";
		return;
	}
	if(regex.test(texto))
	{
		document.getElementById("msmSitioWeb").innerText = "Formato URL aceptado";
		document.getElementById("msmSitioWeb").className = "col-sm-4 text-right control-label text-success";
		document.getElementById("lblSitioWeb").className = "col-sm-3 text-right control-label text-success";
		document.getElementById(id).className = "form-control is-valid";
	}
	else
	{
		document.getElementById("msmSitioWeb").innerText = "Formato URL erróneo";
		document.getElementById("msmSitioWeb").className = "col-sm-4 text-right control-label text-danger";
		document.getElementById("lblSitioWeb").className = "col-sm-3 text-right control-label text-danger";
		document.getElementById(id).className = "form-control is-invalid";
		document.getElementById(id).focus();
	}
}

function RestarMontos(event, id)
{
	var monto_cierre = document.getElementById("txtMontoEstado").value;
	var monto_declarado = document.getElementById(id).value;
	var diferencia = monto_cierre - monto_declarado;
	console.log(monto_cierre);
	document.getElementById("txtDiferencia").value = diferencia;
}