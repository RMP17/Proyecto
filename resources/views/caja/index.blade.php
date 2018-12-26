@extends('maquetas.admin')
@section('page_wrapper')
		<!-- ============================================================== -->
		<!-- Start Page Content -->
		<!-- ============================================================== -->
		<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="page-breadcrumb">
							<div class="row">
								<div class="col-12 d-flex no-block align-items-center">
									<h4 class="card-title m-b-0">Cajas</h4>
									<div class="col-3">
										<a href="" data-target="#modal-create-caja" data-toggle="modal"><button type="button" class="btn btn-outline-dark btn-sm">Nueva</button></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<?php $idSucursal = 0; ?>
					@foreach($cajas as $c)
						@if ($idSucursal != $c -> id_sucursal)
							<?php $idSucursal = $c -> id_sucursal; ?>
							<table class="table">
							<h5> Sucursal : {{$c -> sucursal}} </h5>
							<thead>
								<tr>
									<th scope="col">#</th>
									<th scope="col">Nombre</th>
									<th scope="col">Empleado a cargo</th>
									<th scope="col">Acciones</th>
									</tr>
							</thead>
							<tbody>
							<?php $i = 1; ?>
						@endif
						<tr>
						  <th scope="row">{{$i}}</th>
						  <td>{{ $c -> nombre }}</td>
						  <td>{{ $c -> empleado }}</td>
						  <td>
								<a href="" data-target="#modal-edit-caja-{{$c -> id_caja}}" data-toggle="modal"><button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button></a>
								<a href="" data-target="#modal-delete-caja-{{$c -> id_caja}}" data-toggle="modal"><button type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-delete-forever"></i></button></a>
								<div><div>@include ('caja.edit')</div></div>
								<div><div>@include ('caja.destroy')</div></div>
						  </td>  
						</tr>
						<?php $i++; ?>
						@if ($idSucursal != $c -> id_sucursal)
									</tbody>
							</table>
						@endif
					@endforeach					
				</div>
			</div>
			@include ('caja.create')
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