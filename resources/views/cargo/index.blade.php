<a href data-target="#modal-register-cargo" data-toggle="modal"
   title="Nuevo Cargo">
	<button type="button"
			@click="cancelModeEditCargo"
			class="btn btn-outline-success btn-sm"><i
				class="fas fa-plus"></i></button>
</a>
<table class="table table-sm">
	<thead>
	<tr>
		<th scope="col" width="1%">#</th>
		<th scope="col">Nombre</th>
		<th scope="col">Acciones</th>
	</tr>
	</thead>
	<tbody>
		<tr v-for="(_cargo, index) in cargo.data">
			<th scope="row" width="1%">@{{ index+1}}</th>
			<td>@{{ _cargo.nombre }}</td>
			<td>
				<a href="javascript:void(0)"
				   @click="modeEditCargo(_cargo)"
				   data-backdrop="static"
				   data-keyboad="false"
				   data-target="#modal-edit-cargo"
				   data-toggle="modal"
				   type="button" class="btn btn-warning btn-sm">
					<i class="mdi mdi-pencil"></i>
				</a>
			</td>
		</tr>
	</tbody>
</table>

{{--===============================================Modal Nueva Moneda======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-register-cargo">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title pt-1 pr-1">Nuevo Cargo</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
				</button>
			</div>
			<div class="modal-body pb-0">
				@include('cargo.create')
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" @click="cancelModeEdit"> Cerrar</button>
			</div>
		</div>
	</div>
</div>
{{--===============================================Modal Edit Cargo======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-cargo">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title pt-1 pr-1">Actualizar Cargo</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
				</button>
			</div>
			<div class="modal-body pb-0">
				@include('cargo.create')
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" @click="cancelModeEditCargo"> Cerrar</button>
			</div>
		</div>
	</div>
</div>