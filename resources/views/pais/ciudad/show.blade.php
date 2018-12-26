@extends('maquetas.admin')
@section('page_wrapper')
<div class="container-fluid">

		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="page-breadcrumb">
							<div class="row">
								<div class="col-12 d-flex no-block align-items-center">
									<h4 class="card-title m-b-0">Ciudades</h4>
									<div class="col-3">
										<a href="" data-target="#modal-create-ciudad-{{$id_pais}}" data-toggle="modal"><button type="button" class="btn btn-outline-dark btn-sm">Nuevo</button></a>
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
							  <th scope="col">Acciones</th>
							</tr>
						  </thead>
						  <tbody>
						  <?php $i = 1; ?>
						  @foreach($ciudades as $c)
							<tr>
							  <th scope="row">{{$i}}</th>
							  <td>{{ $c -> nombre }}</td>
							  <td>
							  @if ($c -> id_ciudad > 9)
									<a title="Editar" href="" data-target="#modal-edit-ciudad-{{$c -> id_ciudad}}" data-toggle="modal"><button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button></a>

                                     <a titles="Eliminar" href="" data-target="#modal-delete-ciudad-{{$c->id_ciudad}}" data-toggle="modal"><button type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-delete-forever"></i></button></a>

									<div><div>@include ('pais.ciudad.edit')</div></div>
									<div><div>@include ('pais.ciudad.destroy')</div></div>
							  @endif
							  </td>
							</tr>
							<?php $i++; ?>
							@endforeach
						  </tbody>
					</table>
				</div>
				{{$ciudades -> render()}}
			</div>
			@include ('pais.ciudad.create')
		</div>
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
	@endsection