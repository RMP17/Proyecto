@extends('maquetas.admin')
@section('page_wrapper')
	<div id="app-empleado">
		<div class="page-breadcrumb pb-2">
			<div class="row">
				<div class="col-12 d-flex no-block align-items-center">
					<h4 class="page-title">Empleados</h4>
				  <div class="col-auto">
                        <a href="#" class="btn btn-outline-dark w-10em" @click="empleado.modeCreate=!empleado.modeCreate">
                            <span v-if="!empleado.modeCreate">Nuevo empleado</span>
                            <span v-else>Lista de empleado</span>
                        </a>
                   </div>
			<!-- 	<div class="col-auto">
						<a href="{{url ('empleado/create')}}"><button type="button" class="btn btn-outline-dark no-block">Agregar registro</button></a>
					<a @click="toggleEmpleadoKardex=!toggleEmpleadoKardex" ><button type="button" class="btn btn-outline-dark no-block">Ver Kardex</button></a>
				</div> -->
				</div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- End Bread crumb and right sidebar toggle -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- Container fluid  -->
		<!-- ============================================================== -->
		<div class="container-fluid">
			<!-- ============================================================== -->
			<!-- Start Page Content -->
			<!-- ============================================================== -->
			<div class="row" v-if="!empleado.modeCreate">
				<div class="col-12">
					<div class="card">
						<div class="card-body">
							<h5 class="card-title">Empleados</h5>
							<div class="table-responsive">
								<table id="zero_config" class="table table-striped table-bordered">
									<thead>
									<tr>
										<th>Nombre</th>
										<th>NIT / CI</th>
										<th>Sexo</th>
										<th>Edad</th>
										<th>Sucursal</th>
										<th>Teléfono</th>
										<th>Celular</th>
										<th>Correo</th>
										<th>Dirección</th>
										<th>Registrado en fecha</th>
										<th>P/Referencia</th>
										<th>T/Referencia</th>
										<th>Acciones</th>
									</tr>
									</thead>
									<tbody>
									@foreach($empleados as $e)
										<tr>
											<td>{{ $e -> nombre }}

												@if($e->estatus=='A')

													<span class="waves-effect waves-light btn btn-primary btn-sm">Activo</span>
												@else
													@if($e->estatus=='X')

														<span class="waves-effect waves-light btn btn-danger btn-sm">Inactivo</span>

													@endif
												@endif
											</td>
											<td>{{ $e -> ci }}</td>
											@if ($e -> sexo == 'm')
												<td>Masculino</td>
											@else
												<td>Femenino</td>
											@endif
											<td>{{ ceil($e -> edad/365) -1 }}</td>
											<td>{{ $e -> sucursal }}</td>
											<td>{{ $e -> telefono }}</td>
											<td>{{ $e -> celular }}</td>
											<td>{{ $e -> correo }}</td>
											<td>{{ $e -> direccion }}</td>
											<td>{{ $e -> fecha_registro }}</td>
											<td>{{ $e -> persona_referencia }}</td>
											<td>{{ $e -> telefono_referencia }}</td>
											<td>
												<a title="Editar" href="{{URL::action('EmpleadoControlador@edit', $e -> id_empleado)}}"><button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button></a>
												<a title="Dar de baja" href="" data-target="#modal-delete-empleado-{{$e -> id_empleado}}" data-toggle="modal"><button type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-thumb-down"></i></button></a>

												<!-- <button type="button" class="btn btn-dark btn-sm"><i class="mdi mdi-folder"></i></button >-->
											</td>
										</tr>
										@include('empleado.destroy')
									@endforeach
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div v-else>
				@include('empleado.create')
			</div>

			<!-- ============================================================== -->
			<!-- End PAge Content -->
			<!-- ============================================================== -->
			<!-- ============================================================== -->
			<!-- Right sidebar -->
			<!-- ============================================================== -->
			<!-- .right-sidebar -->
			<!-- ============================================================== -->
			<!-- End Right sidebar -->
			<!-- ============================================================== -->
		</div>
	</div>	
@endsection
@section('scripts')
	<script src="{{asset('js/empleado.js')}}"></script>
	
@endsection