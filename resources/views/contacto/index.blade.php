extends('maquetas.admin')
@section('page_wrapper')
						<!-- ============================================================== -->
				<!-- Bread crumb and right sidebar toggle -->
				<!-- ============================================================== -->
				<div class="page-breadcrumb">
					<div class="row">
						<div class="col-12 d-flex no-block align-items-center">
							<h4 class="page-title">Lista de contactos</h4>
							<div class="col-3">
								<a href="contacto/create"><button type="button" class="btn btn-outline-dark">Agregar registro</button></a>
							</div>
							<div class="ml-auto text-right">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="#">Inicio</a></li>
										<li class="breadcrumb-item active" aria-current="page">Retornar a la página principal</li>
									</ol>
								</nav>
							</div>
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
						<div class="row">
							<div class="col-12">                      
								<div class="card">
									<div class="card-body">
										<h5 class="card-title">Proveedores</h5>
										<div class="table-responsive">
											<table id="zero_config" class="table table-striped table-bordered">
												<thead>
													<tr>
														<th>Nombre</th>
														<th>Teléfono</th>
														<th>Teléfono interno</th>
														<th>Celular</th>
														<th>Correo</th>
														<th>Registrado en fecha</th>
														<th>Estado</th>
														<th>Proveedor</th>
												        <th>Cargo</th>
												        <th>Estado</th>
												        <th>Opciones</th>

													</tr>
												</thead>
												<tbody>
													 @foreach($contactos as $c)
														<tr>
															<td>{{ $c -> nombre }}</td>
															<td>{{ $c -> telefono }}</td>
															<td>{{ $c -> interno }}</td>
															<td>{{ $c -> celular }}</td>
															<td>{{ $c -> correo }}</td>
															<td>{{ $c -> fecha_registro }}</td>
															<td>{{ $c -> estado }}</td>
															<td>{{ $c -> id_proveedor }}</td>
															<td>{{ $c -> id_cargo }}</td>

															 @if($c->estatus=='A')
		                                                     <td> <span class="waves-effect waves-light btn btn-primary btn-sm">Activo</span> </td>
		                                                     @else
		                                                      @if($c->estatus=='X')
		                                                     <td ><span class="waves-effect waves-light btn btn-default btn-sm" style="background: red">Baja</span> </td>
		                                                     @endif
		                                                     @endif
															<td>
																<a href="{{URL::action('ContactoControlador@edit', $c -> id_contacto)}}"><button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button></a>
																 <a href="" data-target="#modal-delete-{{$c -> id_contacto}}" data-toggle="modal"><button type="button" class="btn btn-danger btn-sm"><i <i class="mdi mdi-thumb-down"></i></button></a>
															</td>
														</tr>
												    @include('contacto.destroy')
													@endforeach
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
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
				<!-- ============================================================== -->
				<!-- End Container fluid  -->
				<!-- ============================================================== -->
				<!-- ============================================================== -->
				<!-- footer -->
				<!-- ============================================================== -->
				
				<!-- ============================================================== -->
				<!-- End footer -->
				<!-- ============================================================== -->
			</div>
			<!-- ============================================================== -->
			<!-- End Page wrapper  -->
			<!-- ============================================================== -->
		</div>
		<!-- ============================================================== -->
		<!-- End Wrapper -->
		<!-- ============================================================== -->
		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
		<!-- Bootstrap tether Core JavaScript -->
		<script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
		<script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
		<!-- slimscrollbar scrollbar JavaScript -->
		<script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
		<script src="{{asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>
		<!--Wave Effects -->
		<script src="{{asset('dist/js/waves.js')}}"></script>
		<!--Menu sidebar -->
		<script src="{{asset('dist/js/sidebarmenu.js')}}"></script>
		<!--Custom JavaScript -->
		<script src="{{asset('dist/js/custom.min.js')}}"></script>
		<!-- this page js -->
		<script src="{{asset('assets/extra-libs/multicheck/datatable-checkbox-init.js')}}"></script>
		<script src="{{asset('assets/extra-libs/multicheck/jquery.multicheck.js')}}"></script>
		<script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
		<script>
			/****************************************
			 *       Basic Table                   *
			 ****************************************/
			$('#zero_config').DataTable();
		</script>
@endsection