@extends('maquetas.admin')
@section('page_wrapper')

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Favicon icon -->
		<link rel="icon" type="image/png" sizes="16x16" href="{{asset('nihil/imagenes/OpenRedLogo.png')}}">
		<title>Formulario de gestión de proveedores</title>
		<!-- Custom CSS -->
		<link rel="stylesheet" type="text/css" href="{{asset('assets/extra-libs/multicheck/multicheck.css')}}">
		<link href="{{asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css')}}" rel="stylesheet">
		<link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
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
														<th>Razón Social</th>
														<th>NIT / CI</th>
														<th>Ciudad</th>
														<th>Teléfono</th>
														<th>Celular</th>
														<th>Correo</th>
														<th>Sitio Web</th>
														<th>Dirección</th>
														<th>Registrado en fecha</th>
														<th>Rubro</th>
														<th>Acciones</th>
													</tr>
												</thead>
												<tbody>
													 @foreach($proveedores as $p)
														<tr>
															<td>{{ $p -> razon_social }}</td>
															<td>{{ $p -> nit }}</td>
															<td>{{ $p -> id_ciudad }}</td>
															<td>{{ $p -> telefono }}</td>
															<td>{{ $p -> celular }}</td>
															<td>{{ $p -> correo }}</td>
															<td>{{ $p -> sitio_web}}</td>
															<td>{{ $p -> direccion }}</td>
															<td>{{ $p -> fecha_registro }}</td>
															<td>{{ $p -> rubro }}</td>
															<td>
																<a href="{{URL::action('ProveedorControlador@edit', $p -> id_proveedor)}}"><button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button></a>
																<a href="" data-target="#modal-delete-{{$p->id_proveedor}}" data-toggle="modal" type="submit" > <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></a>
																<a title="Agregar cuenta bancaria" href="{{URL::action('CuentaProveedorControlador@show',$p->id_proveedor)}}" type="submit" class="btn btn-primary btn-sm"><i class="fab fa-cc-visa"></i></a>
															</td>
														</tr>
													@include('proveedor.destroy')
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