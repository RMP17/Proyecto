@extends('maquetas.admin')
@section('page_wrapper')
	<div id="app-caja">
		<div class="page-breadcrumb mb-2">
			<div class="row">
				<div class="col-12 d-flex no-block align-items-center">
					<h4 class="page-title">Cajas</h4>
					<div class="col-auto">
						<nav>
							<div class="nav nav-tabs show active" id="nav-tab" role="tablist">
								<a class="nav-item nav-link w-10em active"
								   id="nav-profile-tab"
								   data-toggle="tab"
								   href="#nav-caja-tab"
								   role="tab"
								   aria-controls="nav-profile"
                                   aria-selected="false">Ver Cajas</a>
                                <a class="nav-item nav-link w-10em"
                                   id="nav-registro-caja-tab"
                                   title="Registro de caja"
                                   data-toggle="tab"
                                   href="#nav-registro-caja"
                                   role="tab"
                                   aria-controls="nav-profile"
                                   aria-selected="false">R. de Caja</a>
                                <a class="nav-item nav-link w-10em"
								   id="nav-gasto"
								   data-toggle="tab"
								   href="#nav-gasto-tab"
								   role="tab"
								   aria-controls="nav-profile"
                                   aria-selected="false">Gastos</a>
								{{--<a class="nav-item nav-link w-10em"
								   id="nav-profile-tab"
								   data-toggle="tab"
								   href="#nav-almacen"
								   role="tab"
								   aria-controls="nav-profile"
								   aria-selected="false">Almacén</a>
								<a class="nav-item nav-link w-10em"
								   id="nav-profile-tab"
								   data-toggle="tab"
								   href="#nav-paises"
								   role="tab"
								   aria-controls="nav-profile"
								   aria-selected="false">Países</a>--}}
							</div>
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
							<div class="tab-content" id="nav-tabContent">
								{{--=================================================NAV TABCONTENT==================================--}}
								{{--=========================================TAP CAJA==========================--}}
								<div class="tab-pane fade show active" id="nav-caja-tab" role="tabpanel"
									 aria-labelledby="nav-profile-tab">
									<div class="container-fluid">
										<div class="card-group mb-0 ">
											@php
												$id_acceso=auth()->user()->id_empleado;
            									$existsPermission = \DB::table('permiso_usuario')->where('id_acceso',$id_acceso)->where('id_permiso',18)->first();
											@endphp

												<div class="card">
													<div class="card-body pl-0">
														<h5 class="card-title text-center">Cajas</h5>
														@if($existsPermission)
														@include('caja.show')
														@endif
													</div>
												</div>
											<div class="card border-0">
												<div class="card-body pr-0">
													<h5 class="card-title text-center">Caja Chica</h5>
													<div v-if="caja.summary">
														<div class="col-md-12 form-control">
															<h4 class="m-0">
																Monto Apertura de la @{{ caja.summary.caja }} :  <span class="float-right">@{{ caja.summary.monto_apertura }}</span>
															</h4>
														</div>
														<div class="col-md-12 form-control">
															<h4 class="m-0">
																Total Ventas:  <span class="float-right">@{{ caja.summary.ventas_total }}</span>
															</h4>
														</div>
														<div class="col-md-12 form-control">
															<h4 class="m-0">
																Total Pagos de Ventas al Créditos : <span class="float-right">@{{ caja.summary.ventas_credito_monto_pagado_total }}</span>
															</h4>
														</div>
														<div class="col-md-12 form-control">
															<h4 class="m-0">
																Total Gastos: <span class="float-right">@{{ caja.summary.gastos_total }}</span>
															</h4>
														</div>
														<div class="col-md-12 form-control mb-3 bg-success text-white">
															<h4 class="m-0">
																Total :
																<span class="float-right">@{{ caja.summary.monto_apertura + caja.summary.ventas_total + caja.summary.ventas_credito_monto_pagado_total - caja.summary.gastos_total }}</span>
															</h4>
														</div>
														<hr>
														<div class="col-md-12 form-control mb-3 bg-warning text-white">
															<h4 class="m-0" title="Este cálculo no toma en cuenta los pagos realizados de las ventas al créditos">
																Total Ventas al Crédito : <span class="float-right">@{{ caja.summary.ventas_credito_total }}</span>
															</h4>
														</div>
													</div>
													@include('cajachica.create')
												</div>
											</div>
										</div>
									</div>
								</div>
								{{--=========================================END TAP CAJA==========================--}}
								{{--=========================================TAP REGISTRO CAJAS==========================--}}
								<div class="tab-pane fade" id="nav-registro-caja" role="tabpanel" aria-labelledby="nav-contact-tab">
									@include('cajachica.show')
								</div>
								{{--=========================================END TAP REGISTRO DE CAJAS==================================--}}
                                {{--=========================================TAP GASTOS==========================--}}
								<div class="tab-pane fade" id="nav-gasto-tab" role="tabpanel" aria-labelledby="nav-contact-tab">
									@include('cajachica.gasto.show')
								</div>
								{{--=========================================END TAP GASTOS==================================--}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script src="{{asset('js/caja.js')}}"></script>
@endsection
