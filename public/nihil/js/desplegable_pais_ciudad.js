const url = 'http://127.0.0.1:3000/Proyecto/public/';
var urlGlobal={
    resourcesCategorias:url + 'categoria',
    resourcesFabricante:url + 'fabricante',
    resourcesArticulo:url + 'articulo',
    getAllFabricantes:url + 'fabricantes',
    getAllCategorias:url + 'categorias',
};

$("#cbxPais").change(function(event){
	// $.get(window.location.href.split("/")[0] + "/ciudades/" + event.target.value, function(response, state)
	$.get(urlGlobal+"ciudades/" + event.target.value, function(response, state)
	{
		$("#cbxCiudad").empty();
		for(i=0; i<response.length; i++)
		{
			$("#cbxCiudad").append("<option value='" + response[i].id_ciudad + "'>" + response[i].nombre + "</option>");
		}
	});
});