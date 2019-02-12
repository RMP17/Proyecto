@extends('maquetas.admin')
@section('page_wrapper')
	<div id="app-movimiento-almacen">
		<div class="page-breadcrumb mb-2">
			<div class="row">
				<div class="col-12 d-flex no-block align-items-center">
					<h4 class="page-title">Movimientos de artículos</h4>
					<div class="col-auto">
						<nav>
							<div class="nav nav-tabs show active" id="nav-tab" role="tablist">
								<a class="nav-item nav-link w-10em active"
								   id="nav-profile-tab"
								   data-toggle="tab"
								   href="#nav-movimientos-tab"
								   role="tab"
								   aria-controls="nav-profile"
                                   aria-selected="false">Ver Movimientos</a>
                                {{--<a class="nav-item nav-link w-10em"
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
                                   aria-selected="false">Gastos</a>--}}
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
								{{--=========================================TAP REGISTRO CAJAS==========================--}}
								<div class="tab-pane fade show active" id="nav-movimientos-tab" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    <div class="container-fluid pr-0 pl-0">
                                        <div class="card-group mb-0 ">
                                            <div class="card col-md-8 p-0">
                                                <div class="card-body p-0">
                                                    <h5 class="card-title text-center">Detalle</h5>
                                                    @include('movimientos_almacen.detalle')
                                                </div>
                                            </div>
                                            <div class="card col-md-4 border-0 pr-0 pl-0">
                                                <div class="card-body p-0">
                                                    <h5 class="card-title text-center">Datos de Movimiento</h5>
                                                    @include('movimientos_almacen.create')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
								</div>
								{{--=========================================END TAP REGISTRO DE CAJAS==================================--}}
								{{--=========================================TAP CAJA==========================--}}
								{{--<div class="tab-pane fade" id="nav-caja-tab" role="tabpanel"
									 aria-labelledby="nav-profile-tab">
									<div class="container-fluid">
										<div class="card-group mb-0 ">
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
													@include('movimientos_almacen.show')
												</div>
											</div>
										</div>
									</div>
								</div>--}}
								{{--=========================================END TAP CAJA==========================--}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script src="{{asset('js/movimientos_almacen.js')}}"></script>
@endsection
