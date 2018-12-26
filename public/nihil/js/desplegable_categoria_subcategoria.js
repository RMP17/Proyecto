$("#cbxCategoria").change(function(event){
	$.get(window.location.href.split("/")[0] + "/subcategorias/" + event.target.value, function(response, state)
	{
		$("#cbxSubcategoria").empty();
		for(i=0; i<response.length; i++)
		{
			$("#cbxSubcategoria").append("<option value='" + response[i].id_subcategoria + "'>" + response[i].subcategoria + "</option>");
		}
	});
});