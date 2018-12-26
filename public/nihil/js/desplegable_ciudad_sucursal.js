$("#cbxCiudad").change(function(event){
	$.get(urlGlobal+"sucursales/" + event.target.value, function(response, state)
	{
		$("#cbxSucursal").empty();
		for(i=0; i<response.length; i++)
		{
			$("#cbxSucursal").append("<option value='" + response[i].id_sucursal + "'>" + response[i].nombre + "</option>");
		}
	});
});