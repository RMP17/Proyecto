<a href data-target="#modal-registro-monedas" data-toggle="modal"
   title="Nueva Moneda">
	<button type="button" class="btn btn-outline-success btn-sm"><i
				class="fas fa-plus"></i></button>
</a>
<div class="table-responsive">
	<table class="table table-sm">
		<thead>
		<tr>
			<th scope="col" width="1%">#</th>
			<th scope="col">Nombre</th>
			<th scope="col">Código</th>
			<th scope="col">País</th>
			<th scope="col">Acciones</th>
		</tr>
		</thead>
		<tbody>

		<tr v-for="(_moneda, index) in moneda.data">
			<th scope="row">@{{ index+1 }}</th>
			<td>@{{ _moneda.nombre }}</td>
			<td>@{{ _moneda.codigo }}</td>
			<td>@{{ _moneda.pais ? _moneda.pais.nombre:''}}</td>
			<td>
				<a href="javascript:void(0)"
				   @click="modeEditMoneda(_moneda)"
				   data-backdrop="static"
				   data-keyboad="false"
				   data-target="#modal-edit-moneda"
				   data-toggle="modal"
				   type="button" class="btn btn-warning btn-sm">
					<i class="mdi mdi-pencil"></i>
				</a>
			{{--<td>
                <a href="" data-target="#modal-delete-moneda-{{$m -> id_moneda}}" data-toggle="modal"><button type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-delete-forever"></i></button></a>
            </td>--}}
		</tr>
		</tbody>
	</table>
</div>


{{--===============================================Modal Nueva Moneda======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-registro-monedas">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title pt-1 pr-1">Nueva Moneda</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
				</button>
			</div>
			<div class="modal-body pb-0">
				@include('moneda.create')
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" @click="cancelModeEdit"> Cerrar</button>
			</div>
		</div>
	</div>
</div>
{{--===============================================Modal Edit Moneda======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-moneda">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title pt-1 pr-1">Actualizar Moneda</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
					<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
				</button>
			</div>
			<div class="modal-body pb-0">
				@include('moneda.create')
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal" @click="cancelModeEditMoneda"> Cerrar</button>
			</div>
		</div>
	</div>
</div>