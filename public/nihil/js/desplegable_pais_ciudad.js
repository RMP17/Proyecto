const url = 'http://127.0.0.1:3000/Proyecto/public/';
var urlGlobal={
    resourcesCategorias:url + 'categoria',
    resourcesFabricante:url + 'fabricante',
    resourcesEmpleados:url + 'empleado',
    getAllCiudades:url + 'ciudades',
    getAllSucursales:url + 'sucursales',
    getAllEmpleados:url + 'empleados',
    resourcesArticulo:url + 'articulo',
    getAllFabricantes:url + 'fabricantes',
    getAllCategorias:url + 'categorias',
    getArticuloForCodigo:url + 'articulo/codigo/',
    getArticuloForId:url + 'articulo/id/',
    getArticuloForCodigoBarras:url + 'articulo/codigo-barras/',
    getArticuloForName:url + 'articulo/query/',
    changeStatusOfArticulo:url + 'articulo/status/',
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