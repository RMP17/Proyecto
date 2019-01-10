@include('kardex.kardex_observaciones.create')
<table class="table table-striped table-bordered table-sm">
	<thead>
	<tr>
		<th scope="col">#</th>
		<th scope="col">Observación</th>
		<th scope="col">Fecha</th>
		<th scope="col">Acciones</th>
	</tr>
	</thead>
	<tbody>
		<tr v-for="(_observaciones, index) in kardex.kardex_observaciones.data">
			<td>@{{ index + 1 }}</td>
			<td>@{{ _observaciones.observacion}}</td>
			<td>@{{ _observaciones.fecha}}</td>
			<td>
                <a href="javascript:void(0)"
                   title="Editar Observación"
                   @click="modeEditKardexObserbacion(_observaciones)"
                   type="button" class="btn btn-warning btn-sm">
                    <i class="mdi mdi-pencil"></i>
                </a>
                <a href="javascript:void(0)"
                   title="Eliminar Observación"
                   @click="deleteKardexObservaciones(_observaciones.id_kardex_observaciones, index)"
                   type="button" class="btn btn-danger btn-sm">
                    <i class="mdi mdi-delete-forever"></i>
                </a>
			</td>
		</tr>
	</tbody>
</table>
	