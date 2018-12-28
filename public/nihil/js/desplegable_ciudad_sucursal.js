$("#cbxCiudad").change(function(event){
	$.get(urlGlobal.getAllSucursales+'/' + event.target.value, function(response, state)
	{
		$("#cbxSucursal").empty();
		$("#cbxSucursal").append("<option>" + " "+ "</option>");
		for(i=0; i<response.length; i++)
		{
			$("#cbxSucursal").append("<option value='" + response[i].id_sucursal + "'>" + response[i].nombre + "</option>");
		}
	});
});