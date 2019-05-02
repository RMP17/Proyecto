<a href data-target="#modal-registro-caja" data-toggle="modal"
   title="Nueva Caja">
	<button type="button" class="btn btn-outline-success btn-sm"><i
				class="fas fa-plus"></i></button>
</a>
<div class="table-responsive">
	<table class="table table-sm">
		<thead>
		<tr>
			<th scope="col">Nombre de la caja</th>
			<th scope="col">Empleado</th>
			<th scope="col">Acciones</th>
		</tr>
		</thead>
		<tbody>
		<tr v-for="(_caja, index) in caja.data">
			<td>@{{ _caja.nombre }}</td>
			<td>@{{ _caja.empleado.nombre }}</td>
			<td>
				<a href="javascript:void(0)"
				   @click="modeEditCaja(_caja)"
				   data-backdrop="static"
				   data-keyboard="false"
				   data-target="#modal-edit-caja"
				   data-toggle="modal"
				   type="button" class="btn btn-warning btn-sm">
					<i class="mdi mdi-pencil"></i>
				</a>
		</tr>
		</tbody>
	</table>
</div>


{{--===============================================Modal Nueva Caja======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-registro-caja">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title pt-1 pr-1">Nueva Caja</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
				</button>
			</div>
			<div class="modal-body pb-0">
				@include('caja.create')
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar</button>
			</div>
		</div>
	</div>
</div>
{{--===============================================Modal Mode Edit======================================--}}
<div class="modal fade modal-slide-in-right"
	 aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-caja">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title pt-1 pr-1">Editar Caja</h4>
				<button type="button" class="close"
						@click="cancelModeEditCaja"
						data-dismiss="modal" aria-label="Cerrar">
					<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
				</button>
			</div>
			<div class="modal-body pb-0">
				@include('caja.create')
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" @click="cancelModeEditCaja"> Cerrar</button>
			</div>
		</div>
	</div>
</div>