const url = 'http://127.0.0.1:8000/';
var urlGlobal={
    resourcesCategorias:url + 'categoria',
    resourcesFabricante:url + 'fabricante',
    resourcesEmpleados:url + 'empleado',
    getAllFabricantes:url + 'fabricantes',
    getAllCategorias:url + 'categorias',
    getAllCiudades:url + 'ciudades',
    getAllSucursales:url + 'sucursales',
    getAllEmpleados:url + 'empleados',
};

$("#cbxPais").change(function(event){
	// $.get(window.location.href.split("/")[0] + "/ciudades/" + event.target.value, function(response, state)
	$.get(urlGlobal.getAllCiudades+'/'+ event.target.value, function(response, state)
	{
		$("#cbxCiudad").empty();
		$("#cbxCiudad").append("<option>" + " "+ "</option>");
		for(i=0; i<response.length; i++)
		{
			$("#cbxCiudad").append("<option value='" + response[i].id_ciudad + "'>" + response[i].nombre + "</option>");
		}
	});
});