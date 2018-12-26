@extends('maquetas.admin')
@section('page_wrapper')
<!-- ============================================================== -->
<!-- Bread crumb and right sidebar toggle -->
<!-- ============================================================== -->
<div class="page-breadcrumb">
	<div class="row">
		<div class="col-12 d-flex no-block align-items-center">
			<h4 class="page-title">Lista de ventas</h4>
			<div class="col-3">
				<a href="{{url ('empleado/create')}}"><button type="button" class="btn btn-outline-success">Nueva venta</button></a>
			</div>
			<div class="ml-auto text-right">
				<nav aria-label="breadcrumb">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="{{url('')}}">Inicio</a></li>
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
					<h5 class="card-title">Ventas</h5>
					<div class="table-responsive">
						<table id="zero_config" class="table table-striped table-bordered">
							<thead>
							<tr>
								<th>Código</th>
								<th>fecha</th>
								<th>Costo total</th>
								<th>Tipo de pago</th>
								<th>Codigo tarjeta/cheque</th>
								<th>Descuento</th>
								<th>Moneda</th>
								<th>Caja</th>
								<th>Cliente</th>
								<th>Acciones</th>
							</tr>
							</thead>
							<tbody>
							@foreach($ventas as $v)
								<tr>
									<td>V-00-{{ $v -> id_venta }}</td>
									<td>{{ $v -> fecha }}</td>
									<td>{{ $v -> costo_total }}</td>
									<td>{{ $v -> tipo_pago }}</td>
									<td>{{ $v -> codigo_tarjeta_cheque }}</td>
									<td>{{ $v -> descuento }}</td>
									<td>{{ $v -> moneda }}</td>
									<td>{{ $v -> caja }}</td>
									<td>{{ $v -> cliente }}</td>
									<td>

									</td>
								</tr>
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
@endsection