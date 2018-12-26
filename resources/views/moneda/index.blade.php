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
									<h4 class="card-title m-b-0">Monedas</h4>
									<div class="col-3">
										<a href="" data-target="#modal-create-moneda" data-toggle="modal"><button type="button" class="btn btn-outline-dark btn-sm">Nueva</button></a>
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
							  <th scope="col">Código</th>
							  <th scope="col">País</th>
							  <th scope="col">Acciones</th>
							</tr>
						  </thead>
						  <tbody>
						  <?php $i = 1; ?>
						  @foreach($monedas as $m)
							<tr>
							  <th scope="row">{{$i}}</th>
							  <td>{{ $m -> nombre }}</td>
							  <td>{{ $m -> codigo }}</td>
							  <td>{{ $m -> pais }}</td>
							  @if ($m -> id_moneda > 2)
							  <td>
									<a href="" data-target="#modal-edit-moneda-{{$m -> id_moneda}}" data-toggle="modal"><button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button></a>
									<a href="" data-target="#modal-delete-moneda-{{$m -> id_moneda}}" data-toggle="modal"><button type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-delete-forever"></i></button></a>	
									<div><div>@include ('moneda.edit')</div></div>
									<div><div>@include ('moneda.destroy')</div></div>
							  @endif
							  </td>
							</tr>
							<?php $i++; ?>
							@endforeach
						  </tbody>
					</table>				</div>
				{{$monedas -> render()}}
			</div>
			@include ('moneda.create')
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