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
								   href="#nav-config"
								   role="tab"
								   aria-controls="nav-profile"
								   aria-selected="false">Ver Cajas</a>
								{{--<a class="nav-item nav-link w-10em"
								   id="nav-profile-tab"
								   data-toggle="tab"
								   href="#nav-empleados"
								   role="tab"
								   aria-controls="nav-profile"
								   aria-selected="false">Empleados</a>
								<a class="nav-item nav-link w-10em"
								   id="nav-profile-tab"
								   data-toggle="tab"
								   href="#nav-empresa"
								   role="tab"
								   aria-controls="nav-profile"
								   aria-selected="false">Empresa</a>
								<a class="nav-item nav-link w-10em"
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
								{{--=========================================TAP CONFIG==========================--}}
								<div class="tab-pane fade show active" id="nav-config" role="tabpanel"
									 aria-labelledby="nav-profile-tab">
									<div class="container-fluid">
										<div class="card-group mb-0 ">
											<div class="card">
												<div class="card-body pl-0">
													<h5 class="card-title text-center">Cajas</h5>
													@include('caja.show')
												</div>
											</div>
											<div class="card border-0">
												<div class="card-body pr-0">
													<h5 class="card-title text-center">Caja Chica</h5>
													@include('cajachica.index')
												</div>
											</div>
										</div>
									</div>
								</div>
								{{--=========================================END TAP CONFIG==========================--}}
								{{--=========================================TAP PAISES==========================--}}
								<div class="tab-pane fade" id="nav-paises" role="tabpanel" aria-labelledby="nav-contact-tab">
									{{--@include('pais.index')--}}
								</div>
								{{--=========================================END TAP PAISES==================================--}}
							</div>
						</div>
					</div>
					{{--{{$compras -> render()}}--}}
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
	</div>
@endsection
@section('scripts')
	<script src="{{asset('js/caja.js')}}"></script>
@endsection
