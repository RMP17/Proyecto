<!DOCTYPE html>
<html dir="categoria/subcategoria" lang="en">

	<head>
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
	</head>

	<body>
		<!-- ============================================================== -->
		<!-- Start Page Content -->
		<!-- ============================================================== -->
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="page-breadcrumb">
							<div class="row">
								<div class="col-12 d-flex no-block align-items-center">
									<h4 class="card-title m-b-0">Subcategorías</h4>
									<div class="col-3">
										<a href="" data-target="#modal-create-subcategoria-{{$id_categoria}}" data-toggle="modal"><button type="button" class="btn btn-outline-dark btn-sm">Nueva</button></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<table class="table">
						  <thead>
							<tr>
							  <th scope="col">#</th>
							  <th scope="col">Nombre</th>
							  <th scope="col">Descripción</th>
							  <th scope="col">Acciones</th>
							</tr>
						  </thead>
						  <tbody>
						  <?php $i = 1; ?>
						  @foreach($subcategorias as $s)
							<tr>
							  <th scope="row">{{$i}}</th>
							  <td>{{ $s -> subcategoria}}</td>
							  <td>{{ $s -> descripcion}}</td>
							  <td>
							  @if ($s -> id_subcategoria > 1)
									<a title="Editar" href="" data-target="#modal-edit-subcategoria-{{$s -> id_subcategoria}}" data-toggle="modal"><button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button></a>
                                     <a title="Eliminar" href="" data-target="#modal-delete-subcategoria-{{$s->id_subcategoria}}" data-toggle="modal"><button type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-delete-forever"></i></button></a>
									<div><div>@include ('categoria.subcategoria.edit')</div></div>
									<div><div>@include ('categoria.subcategoria.destroy')</div></div>
							  @endif
							  </td>
							</tr>
							<?php $i++; ?>
							@endforeach
						  </tbody>
					</table>
				</div>
				{{$subcategorias -> render()}}
			</div>
			@include ('categoria.subcategoria.create')
		</div>
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
	</body>

</html>