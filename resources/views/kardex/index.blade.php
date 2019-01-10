<div class="table-responsive">
	<table class="table table-striped table-bordered table-sm">
		<thead>
		<tr>
			<th>Cargo</th>
			<th>Salario</th>
			<th>Fecha inicio</th>
			<th>Fecha de baja</th>
			<th>Acciones</th>
		</tr>
		</thead>
		<tbody>
			<tr v-for="_kardex in kardex.data">
				<td>@{{ _kardex.cargo ? _kardex.cargo.nombre: ''}}</td>
				<td>
					@{{ _kardex.salario.monto +' '+_kardex.salario.simbolo }}
				</td>
				<td>@{{ _kardex.fecha_inicio }}</td>
				<td>@{{ _kardex.fecha_baja }}</td>
				<td>
					<a href="javascript:void(0)"
					   title="Ver Observaciones"

					   data-backdrop="static"
					   data-keyboad="false"
					   data-target="#modal-kardex-observaciones"
					   data-toggle="modal"
					   type="button" class="btn btn-info btn-sm">
						<i class="far fa-comment-alt"></i>
					</a>
				</td>
			</tr>
		</tbody>
	</table>
</div>
