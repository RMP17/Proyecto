
$("#cbxSucursal").change(function(event){
	$.get(urlGlobal+'empleados/' + event.target.value, function(response, state)
	{
		$("#cbxEmpleado").empty();
		for(i=0; i<response.length; i++)
		{
			$("#cbxEmpleado").append("<option value='" + response[i].id_empleado + "'>" + response[i].nombre + "</option>");
		}
	});
});