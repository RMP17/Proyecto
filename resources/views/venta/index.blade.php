@extends('maquetas.admin')
@section('page_wrapper')
<div id="app-venta">
	<div class="page-breadcrumb mb-2">
		<div class="row">
			<div class="col-12 d-flex no-block align-items-center">
				<h4 class="page-title">Ventas</h4>
				<div class="col-auto">
					{{--<a type="button" class="btn btn-outline-purple" href="{{url ('compra/create')}}">Registrar nuevo</a>
                    <a href="#" type="button" class="btn btn-outline-dark w-10em">
                        <span>Proveedores</span>
                    </a>--}}
					<nav>
						<div class="nav nav-tabs" id="nav-tab" role="tablist">
							<a class="nav-item nav-link w-10em active"
							   id="nav-home-tab" data-toggle="tab"
							   href="#nav-vender" role="tab"
							   aria-controls="nav-vender"
							   aria-selected="true">Vender</a>
							<a title="Registro de Ventas" class="nav-item nav-link w-10em"
							   id="nav-profile-tab"
							   data-toggle="tab"
							   href="#nav-registro-ventas"
							   role="tab"
							   aria-controls="nav-register-venta"
							   aria-selected="false">R. de Ventas</a>
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
							<div class="tab-pane fade show active" id="nav-vender" role="tabpanel"
								 aria-labelledby="nav-home-tab">
								@include('venta.create')
							</div>
							<div class="tab-pane fade" id="nav-registro-ventas" role="tabpanel"
								 aria-labelledby="nav-registro-ventas-tab">
								<div class="row mb-3">
									<div class="col-md-8 offset-2 pr-5 pl-5">
										<app-dates @date-range="getVentasByRageDate"></app-dates>
									</div>
								</div>
								<div class="d-md-flex flex-row">
									<div v-if="!venta.hideFilters">
										<app-online-suggestions-objects v-if="!venta.hideSuggestions"
																		:config="configEmpleado"
																		@selected-suggestion-event="filterByEmpleado">
										</app-online-suggestions-objects>
									</div>
									<div v-if="!venta.hideFilters">
										<select class="custom-select"
												@change="filterByAlmacen"
												name="cbxFilterAlmacen">
											<option :value="null" disabled selected>Seleccione Almacen</option>
											<option v-for="_almacen in almacenes" :value="_almacen.id_almacen">
												@{{ _almacen.codigo }}
											</option>
										</select>
									</div>
									<div v-if="!venta.hideFilters" class="col p-0">
										<app-online-suggestions-objects v-if="!venta.hideSuggestions"
																		:config="configCliente"
																		@selected-suggestion-event="filterByCliente">
										</app-online-suggestions-objects>
									</div>
									<div>
										<button class="btn btn-outline-secondary"
												@click="getSalesOnCreditInForce"
										>Ventas al crédito vigentes</button>
									</div>
									<div class="ml-auto">
										<div class="input-group">
											<a href="javascript:void(0);" type="button"
											   title="Límpiar filtros"
											   class="btn btn-outline-secondary"
											   @click="removeFilters"
											><i class="fas fa-ban fa-lg"></i>
											</a>
											<a href="javascript:void(0);" type="button"
											   title="Exportar a PDF"
											   @click="exportPdf"
											   class="btn btn-outline-danger"
											><i class="far fa-file-pdf fa-lg"></i>
											</a>
											<a href="javascript:void(0);" type="button"
											   title="Átras"
											   class="btn btn-outline-secondary"
											   :class="venta.paginated.pageNumber === 0 ? 'disabled':''"
											   @click="prevPage"
											><i class="fas fa-arrow-left fa-lg"></i>
											</a>
											<div class="input-group-prepend">
                                                <span title="Página actual" class="input-group-text">
                                                @{{ venta.paginated.pageNumber+1 }}
                                                </span>
											</div>

											<a href="javascript:void(0);" type="button"
											   title="Siguiente"
											   class="btn btn-outline-secondary"
											   :class="venta.paginated.pageNumber >= pageCount -1 ? 'disabled':''"
											   @click="nextPage"
											><i class="fas fa-arrow-right fa-lg"></i>
											</a>
										</div>
									</div>
								</div>
								<div class="table-responsive" >
									<table class="table table-striped table-bordered table-sm">
										<thead>
										<tr>
											<th>Fecha</th>
											<th>Empleado</th>
											<th>Cliente</th>
											<th>Caja</th>
											<th>Almacen</th>
											<th>Costo Total</th>
											<th>Descuento</th>
											<th>Tipo de pago</th>
											<th>Código</th>
											<th>Acciones</th>
										</tr>
										</thead>
										<tbody>
										<tr v-for="_venta in paginatedData" :class="_venta.estatus==='vc' ? 'table-danger':''">
											<td>@{{ _venta.fecha }}</td>
											<td>@{{ _venta.empleado }}</td>
											<td>
												<span v-if="_venta.nit">Nit: @{{ _venta.nit }}<br></span>
												@{{ _venta.cliente }}
											</td>
                                            <td>@{{ _venta.caja }}</td>
											<td>@{{ _venta.almacen }}</td>
											<td>@{{ _venta.costo_total+' '+_venta.moneda }}</td>
											<td>@{{ _venta.descuento }}</td>
											<td>
												<span v-if="_venta.tipo_pago ==='ef'">Efectivo</span>
												<span v-if="_venta.tipo_pago ==='cr'">Crédito</span>
												<span v-if="_venta.tipo_pago ==='ch'">Cheque</span>
												<span v-if="_venta.tipo_pago ==='tc'">Tarjeta de crédito o débito</span>
											</td>
											<td>@{{ _venta.codigo_tarjeta_cheque }}</td>
											<td>
												<a href="javascript:void(0)"
												   title="Ver detalle"
												   @click="viewDetallesVenta(_venta)"
												   data-target="#modal-view-detail-venta"
												   data-toggle="modal"
												   type="button" class="btn btn-outline-info btn-sm">
													<i class="fas fa-eye fa-lg"></i>
												</a>
												<a href="javascript:void(0)"
												   title="Imprimir"
												   @click="getVentaById(_venta)"
												   type="button" class="btn btn-outline-info btn-sm lh-1">
													<i class="mdi mdi-printer mdi-18px"></i>
												</a>
												<a href="javascript:void(0)"
												   v-if="_venta.tipo_pago==='cr'"
												   title="Ver venta al crédito"
												   @click="assignAnIdentificationOfVentaToCredito(_venta)"
												   data-target="#modal-view-credit-sale"
												   data-toggle="modal"
												   type="button" class="btn btn-outline-info btn-sm">
													<i class="fas fa-hand-holding-usd fa-lg"></i>
												</a>
												<a v-if="_venta.estatus==='null' || _venta.estatus!=='vc'" href="javascript:void(0)"
												   title="Anular Venta"
                                                   @click="cancelSale(_venta)"
												   type="button" class="btn btn-outline-danger btn-sm">
													<i class="far fa-trash-alt fa-lg"></i>
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
											<th>Cliente</th>
											<th>Caja</th>
											<th>Almacen</th>
											<th>Costo Total</th>
											<th>Descuento</th>
											<th>Tipo de pago</th>
											<th>Código</th>
										</tr>
										</thead>
										<tbody>
										<tr v-for="_venta in paginatedData">
											<td>@{{ _venta.fecha }}</td>
											<td>@{{ _venta.empleado }}</td>
											<td>
												<span v-if="_venta.nit">Nit: @{{ _venta.nit }}<br></span>
												@{{ _venta.cliente }}
											</td>
											<td>@{{ _venta.caja }}</td>
											<td>@{{ _venta.almacen }}</td>
											<td>@{{ _venta.costo_total+' '+_venta.moneda }}</td>
											<td>@{{ _venta.descuento }}</td>
											<td>
												<span v-if="_venta.tipo_pago ==='ef'">Efectivo</span>
												<span v-if="_venta.tipo_pago ==='cr'">Crédito</span>
												<span v-if="_venta.tipo_pago ==='ch'">Cheque</span>
												<span v-if="_venta.tipo_pago ==='tc'">Tarjeta de crédito o débito</span>
											</td>
											<td>@{{ _venta.codigo_tarjeta_cheque }}</td>
											<td>
                                                <span v-if="_venta.estatus==='vc'">cancelada</span>
                                            </td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
							{{--=========================================NAV TABCONTENT==========================--}}
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
	{{--===============================================Modal View Detail Venta======================================--}}
	<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1"
		 id="modal-view-detail-venta">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title pt-1 pr-1">Detalle</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
					</button>
				</div>
				<div class="modal-body pb-0">
					@include('venta.show_detalle_venta')
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
		 id="modal-view-credit-sale">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title pt-1 pr-1">Venta al crédito</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
						<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
					</button>
				</div>
				<div class="modal-body pb-0">
					@include('venta.credito_venta')
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">
						Cerrar
					</button>
				</div>
			</div>
		</div>
	</div>

	{{--===============================================Modal Print Area======================================--}}
	@include('comprobante.comprobante')
</div>
@endsection
@section('scripts')
	<script src="{{asset('js/venta.js')}}"></script>
@endsection
