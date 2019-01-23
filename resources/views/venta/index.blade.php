@extends('maquetas.admin')
@section('page_wrapper')
<div id="app-compra">
	<div class="page-breadcrumb mb-2">
		<div class="row">
			<div class="col-12 d-flex no-block align-items-center">
				<h4 class="page-title">Compras</h4>
				<div class="col-auto">
					{{--<a type="button" class="btn btn-outline-purple" href="{{url ('compra/create')}}">Registrar nuevo</a>
                    <a href="#" type="button" class="btn btn-outline-dark w-10em">
                        <span>Proveedores</span>
                    </a>--}}
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link w-10em active"
							   id="nav-home-tab" data-toggle="tab"
							   href="#nav-compra" role="tab"
							   aria-controls="nav-home"
							   aria-selected="true">Comprar</a>
							<a title="Registro de Compras" class="nav-item nav-link w-10em"
							   id="nav-profile-tab"
							   data-toggle="tab"
							   href="#nav-registro-compras"
							   role="tab"
							   aria-controls="nav-register-compra"
							   aria-selected="false">R. de Compras</a>
							<a class="nav-item nav-link w-10em"
							   id="nav-profile-tab"
							   data-toggle="tab"
							   href="#nav-proveedores"
							   role="tab"
							   aria-controls="nav-profile"
							   aria-selected="false">Proveedores</a>
						</div>
					</nav>
					{{--<a href="#" v-if="!articulo.modeEdit"  class="btn btn-outline-dark w-10em" --}}{{--@click="articulo.modeCreate=!articulo.modeCreate"--}}{{-->
                        <span  v-if="!articulo.modeCreate">Nuevo Artículo</span>
                        <span v-else>Lista de Artículos</span>
                    </a>--}}
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
							{{--=========================================NAV TABCONTENT==========================--}}
							<div class="tab-pane fade show active" id="nav-compra" role="tabpanel"
								 aria-labelledby="nav-home-tab">
								@include('compra.create')
							</div>
							<div class="tab-pane fade" id="nav-registro-compras" role="tabpanel"
								 aria-labelledby="nav-resgister-compra-tab">
								<div class="row mb-3">
									<div class="col-md-8 offset-2 pr-5 pl-5">
										<app-dates @date-range="getComprasByRageDate"></app-dates>
									</div>
								</div>
								<div class="d-flex flex-row">
									<div>
										<a href="javascript:void(0);" type="button"
										   title="Límpiar filtros"
										   class="btn btn-outline-secondary"
										   @click="removeFilters"
										><i class="fas fa-ban fa-lg"></i>
										</a>
									</div>
									<div v-if="!compra.hideFilters">
										<app-online-suggestions-objects v-if="!compra.hideSuggestions"
																		:config="configEmpleado"
																		@selected-suggestion-event="filterByEmpleado">
										</app-online-suggestions-objects>
									</div>
									<div v-if="!compra.hideFilters">
										<select class="custom-select"
												@change="filterByAlmacen"
												name="cbxFilterAlmacen">
											<option :value="null" disabled selected>Seleccione Almacen</option>
											<option v-for="_almacen in almacenes" :value="_almacen.id_almacen">
												@{{ _almacen.codigo }}
											</option>
										</select>
									</div>
									<div v-if="!compra.hideFilters">
										<app-online-suggestions-objects v-if="!compra.hideSuggestions"
																		:config="configProveedor"
																		@selected-suggestion-event="filterByProveedor">
										</app-online-suggestions-objects>
									</div>
									<div>
										<button class="btn btn-outline-secondary"
												@click="getPurchasesOnCreditInForce"
										>Ver Compras al Credito</button>
									</div>
									<div class="ml-auto">
										<a href="javascript:void(0);" type="button"
										   title="Exportar a PDF"
										   @click="exportPdf"
										   class="btn btn-outline-danger btn-sm"
										><i class="far fa-file-pdf fa-lg"></i>
										</a>
										<a href="javascript:void(0);" type="button"
										   title="Átras"
										   class="btn btn-outline-secondary btn-sm"
										   :class="compra.paginated.pageNumber === 0 ? 'disabled':''"
										   @click="prevPage"
										><i class="fas fa-arrow-left fa-lg"></i>
										</a>
										<span title="Página actual">
                                                @{{ compra.paginated.pageNumber+1 }}
                                            </span>
										<a href="javascript:void(0);" type="button"
										   title="Siguiente"
										   class="btn btn-outline-secondary btn-sm"
										   :class="compra.paginated.pageNumber >= pageCount -1 ? 'disabled':''"
										   @click="nextPage"
										><i class="fas fa-arrow-right fa-lg"></i>
										</a>
									</div>
								</div>
								<div class="table-responsive" >
									<table class="table table-striped table-bordered table-sm">
										<thead>
										<tr>
											<th>Fecha</th>
											<th>Empleado</th>
											<th>Proveedor</th>
											<th>Costo Total</th>
											<th>Tipo de pago</th>
											<th>Código</th>
											<th>Almacen</th>
											<th>Observaciones</th>
											<th>Acciones</th>
										</tr>
										</thead>
										<tbody>
										<tr v-for="_compra in paginatedData">
											<td>@{{ _compra.fecha }}</td>
											<td>@{{ _compra.empleado }}</td>
											<td>
												<span v-if="_compra.nit">Nit: @{{ _compra.nit }}<br></span>
												@{{ _compra.proveedor }}
											</td>
											<td>@{{ _compra.costo_total+' '+_compra.moneda }}</td>
											<td>
												<span v-if="_compra.tipo_pago ==='ef'">Efectivo</span>
												<span v-if="_compra.tipo_pago ==='cr'">Crédito</span>
												<span v-if="_compra.tipo_pago ==='ch'">Cheque</span>
												<span v-if="_compra.tipo_pago ==='tc'">Tarjeta de crédito o débito</span>
											</td>
											<td>@{{ _compra.codigo_tarjeta_cheque }}</td>
											<td>@{{ _compra.almacen }}</td>
											<td>@{{ _compra.observaciones}}</td>
											<td>
												<a href="javascript:void(0)"
												   title="Ver detalle"
												   @click="viewDetallesCompra(_compra)"
												   data-target="#modal-view-detail"
												   data-toggle="modal"
												   type="button" class="btn btn-outline-info btn-sm">
													<i class="fas fa-eye fa-lg"></i>
												</a>
												<a href="javascript:void(0)"
												   v-if="_compra.estatus==='cv'"
												   title="Ver compra al crédito"
												   @click="assignAnIdentificationOfCompraToCredito(_compra)"
												   data-target="#modal-view-credit"
												   data-toggle="modal"
												   type="button" class="btn btn-outline-info btn-sm">
													<i class="fas fa-hand-holding-usd fa-lg"></i>
												</a>
											</td>
										</tr>
										</tbody>
									</table>
									<table v-show="false" id="content">
										<thead>
										<tr>
											<th>Fecha</th>
											<th>Empleado</th>
											<th>Proveedor</th>
											<th>Costo Total</th>
											<th>Tipo de pago</th>
											<th>Código</th>
											<th>Almacen</th>
											<th>Observaciones</th>
										</tr>
										</thead>
										<tbody>
										<tr v-for="_compra in paginatedData">
											<td>@{{ _compra.fecha }}</td>
											<td>@{{ _compra.empleado }}</td>
											<td>
												<span v-if="_compra.nit">Nit: @{{ _compra.nit }}<br></span>
												@{{ _compra.proveedor }}
											</td>
											<td>@{{ _compra.costo_total+' '+_compra.moneda }}</td>
											<td>
												<span v-if="_compra.tipo_pago ==='ef'">Efectivo</span>
												<span v-if="_compra.tipo_pago ==='cr'">Crédito</span>
												<span v-if="_compra.tipo_pago ==='ch'">Cheque</span>
												<span v-if="_compra.tipo_pago ==='tc'">Tarjeta de crédito o débito</span>
											</td>
											<td>@{{ _compra.codigo_tarjeta_cheque }}</td>
											<td>@{{ _compra.almacen }}</td>
											<td>@{{ _compra.observaciones}}</td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
							{{--=========================================NAV TABCONTENT==========================--}}
							{{--=========================================TAP PROVEEDORES=========================--}}
							<div class="tab-pane fade" id="nav-proveedores" role="tabpanel"
								 aria-labelledby="nav-profile-tab">
								@include('proveedor.index')
							</div>
							{{--=========================================END TAP PROVEEDORES=====================--}}
							{{--=========================================END TAP PAISES==========================--}}
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
	{{--===============================================Modal View Detail======================================--}}
	<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1"
		 id="modal-view-detail">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title pt-1 pr-1">Detalle</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
					</button>
				</div>
				<div class="modal-body pb-0">
					@include('compra.detalle_compra')
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						Cerrar
					</button>
				</div>
			</div>
		</div>
	</div>
	{{--===============================================Modal Credits======================================--}}
	<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1"
		 id="modal-view-credit">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title pt-1 pr-1">Compra al crédito</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
					</button>
				</div>
				<div class="modal-body pb-0">
					@include('compra.credito_compra')
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						Cerrar
					</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection