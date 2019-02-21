@extends('maquetas.admin')
@section('page_wrapper')

    <script type="text/javascript">
        let almacenes_php = @json($almacenes);
    </script>
    <div id="app-produccion">
        <div class="page-breadcrumb mb-2">
            <div class="row">
                <div class="d-flex no-block align-items-center">
                    <h4 class="page-title">Producción</h4>
                    <div class="col">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link w-10em active"
                                   id="nav-view" data-toggle="tab"
                                   href="#nav-producir" role="tab"
                                   aria-controls="nav-vender"
                                   aria-selected="true">Producir</a>
                                <a title="Registro de Producciones" class="nav-item nav-link w-10em"
                                   id="nav-profile-tab"
                                   data-toggle="tab"
                                   href="#nav-registro-producciones"
                                   role="tab"
                                   aria-controls="nav-register-venta"
                                   aria-selected="false">R. Producciones</a>
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
                                {{--=========================================NAV TABCONTENT==========================--}}
                                <div class="tab-pane fade show active" id="nav-producir" role="tabpanel"
                                     aria-labelledby="nav-home-tab">
                                    @include('produccion.create')
                                </div>
                                <div class="tab-pane fade" id="nav-registro-producciones" role="tabpanel"
                                     aria-labelledby="nav-registro-ventas-tab">
                                    <div class="row mb-3">
                                        <div class="col-md-8 offset-2 pr-5 pl-5">
                                            <app-dates @date-range="getProduccionesByRageDate"></app-dates>
                                        </div>
                                    </div>
                                    <div class="d-md-flex flex-row">
                                        <div v-if="!produccion.hideFilters">
                                            <input type="text" class="form-control"
                                                   @keypress.enter="getProduccionById($event.target.value)"
                                                   placeholder="Código de producción">
                                        </div>
                                        <div class="col p-0" v-if="!produccion.hideFilters">
                                            <app-online-suggestions-objects :config="configEmpleado"
                                                                            @selected-suggestion-event="filterByEmpleado">
                                            </app-online-suggestions-objects>
                                        </div>
                                        <div v-if="!produccion.hideFilters">
                                            <select class="custom-select"
                                                    @change="filterByAlmacen"
                                                    name="slctFilterAlmacen">
                                                <option :value="null" disabled selected>Seleccione Almacen</option>
                                                <option v-for="_almacen in almacenes" :value="_almacen.id_almacen">
                                                    @{{ _almacen.codigo }}
                                                </option>
                                            </select>
                                        </div>
                                        <div v-if="!produccion.hideFilters" class="col p-0">
                                            <app-online-suggestions-objects
                                                                            :config="configCliente"
                                                                            @selected-suggestion-event="filterByCliente">
                                            </app-online-suggestions-objects>
                                        </div>
                                        <div>
                                            <button class="btn btn-outline-secondary"
                                                    @click="forceGetProductionCredits"
                                            >Créditos vigentes
                                            </button>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="input-group">
                                                <a href="javascript:void(0);" type="button"
                                                   title="Límpiar filtros"
                                                   class="btn btn-outline-secondary"
                                                   @click="removeFilters"
                                                ><i class="fas fa-ban fa-lg"
                                                    ></i></a>
                                                <a href="javascript:void(0);" type="button"
                                                   title="Exportar a PDF"
                                                   @click="exportPdf"
                                                   class="btn btn-outline-danger"
                                                ><i class="far fa-file-pdf fa-lg"
                                                    ></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-md-flex flex-row">
                                        <div class="ml-auto">
                                            <div class="input-group">
                                                <a href="javascript:void(0);" type="button"
                                                   title="Átras"
                                                   class="btn btn-outline-secondary"
                                                   :class="produccion.paginated.pageNumber === 0 ? 'disabled':''"
                                                   @click="prevPage"
                                                ><i class="fas fa-arrow-left fa-lg"
                                                    ></i></a>
                                                <div class="input-group-prepend">
                                                <span title="Página actual" class="input-group-text">
                                                @{{ produccion.paginated.pageNumber+1 }}
                                                </span>
                                                </div>
                                                <a href="javascript:void(0);" type="button"
                                                   title="Siguiente"
                                                   class="btn btn-outline-secondary"
                                                   :class="produccion.paginated.pageNumber >= pageCount -1 ? 'disabled':''"
                                                   @click="nextPage"
                                                ><i class="fas fa-arrow-right fa-lg"
                                                    ></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-sm">
                                            <thead>
                                            <tr>
                                                <th>Empleado</th>
                                                <th>Cliente</th>
                                                <th>Caja</th>
                                                <th>Fecha de pedido</th>
                                                <th>Fecha de entrega</th>
                                                <th>Almacen</th>
                                                <th>Costo Total</th>
                                                <th>Tipo de pago</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="_produccion in paginatedData"
                                                :class="_produccion.estatus==='vc' ? 'table-danger':''">
                                                <td>@{{ _produccion.empleado }}</td>
                                                <td>
                                                    <span>Nit: @{{ _produccion.cliente.nit }}</span><br>
                                                    @{{ _produccion.cliente.razon_social }}
                                                </td>
                                                <td>@{{ _produccion.caja }}</td>
                                                <td>@{{ _produccion.fecha_inicio }}</td>
                                                <td>@{{ _produccion.fecha_entrega }}</td>
                                                <td>@{{ _produccion.almacen }}</td>
                                                <td>@{{ _produccion.costo_total }}</td>
                                                <td>
                                                    <span v-if="_produccion.tipo_pago ==='ef'">Efectivo</span>
                                                    <span v-if="_produccion.tipo_pago ==='cr'">Crédito</span>
                                                    <span v-if="_produccion.tipo_pago ==='ch'">Cheque</span>
                                                    <span v-if="_produccion.tipo_pago ==='co'">Solo Cotización</span>
                                                    <span v-if="_produccion.tipo_pago ==='tc'">Tarjeta de crédito o débito</span>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                       title="Ver detalle"
                                                       @click="viewDetallesProduccion(_produccion)"
                                                       data-target="#modal-view-detail-produccion"
                                                       data-toggle="modal"
                                                       type="button" class="btn btn-outline-info btn-sm">
                                                        <i class="fas fa-eye fa-lg"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                       title="Imprimir"
                                                       @click="printProduccion(_produccion)"
                                                       type="button" class="btn btn-outline-info btn-sm lh-1">
                                                        <i class="mdi mdi-printer mdi-18px"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                       v-if="_produccion.tipo_pago==='cr'"
                                                       title="Ver Producción al crédito"
                                                       @click="selectCreditProduccion(_produccion)"
                                                       data-target="#modal-view-credit-produccion"
                                                       data-toggle="modal"
                                                       type="button" class="btn btn-outline-info btn-sm">
                                                        <i class="fas fa-hand-holding-usd fa-lg"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                       title="Imprimir etiqueta"
                                                       @click="printEtiqueta(_produccion)"
                                                       type="button" class="btn btn-outline-info btn-sm lh-1">
                                                        <i class="mdi mdi-note mdi-18px"></i>
                                                    </a>
                                                    {{--
                                                    <a v-if="_produccion.estatus==='null' || _produccion.estatus!=='vc'" href="javascript:void(0)"
                                                       title="Anular Venta"
                                                       @click="cancelSale(_produccion)"
                                                       type="button" class="btn btn-outline-danger btn-sm">
                                                        <i class="far fa-trash-alt fa-lg"></i>
                                                    </a>--}}
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table v-show="false" id="exportproduccion">
                                            <thead>
                                            <tr>
                                                <th>Empleado</th>
                                                <th>Cliente</th>
                                                <th>Caja</th>
                                                <th>Fecha de pedido</th>
                                                <th>Fecha de entrega</th>
                                                <th>Almacen</th>
                                                <th>Costo Total</th>
                                                <th>Tipo de pago</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="_produccion in paginatedData">
                                                <td>@{{ _produccion.empleado }}</td>
                                                <td>
                                                    <span>Nit: @{{ _produccion.cliente.nit }}</span>
                                                    <span>@{{ _produccion.cliente.razon_social }}</span>
                                                </td>
                                                <td>@{{ _produccion.caja }}</td>
                                                <td>@{{ _produccion.fecha_inicio }}</td>
                                                <td>@{{ _produccion.fecha_entrega }}</td>
                                                <td>@{{ _produccion.almacen }}</td>
                                                <td>@{{ _produccion.costo_total }}</td>
                                                <td>
                                                    <span v-if="_produccion.tipo_pago ==='ef'">Efectivo</span>
                                                    <span v-if="_produccion.tipo_pago ==='cr'">Crédito</span>
                                                    <span v-if="_produccion.tipo_pago ==='ch'">Cheque</span>
                                                    <span v-if="_produccion.tipo_pago ==='co'">Solo Cotización</span>
                                                    <span v-if="_produccion.tipo_pago ==='tc'">Tarjeta de crédito o débito</span>
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
             id="modal-view-detail-produccion">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title pt-1 pr-1">Detalle @{{ produccion.oneProduccion ?
                            produccion.oneProduccion.cliente.razon_social:'' }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        @include('produccion.show_detalle_venta')
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
             id="modal-view-credit-produccion">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title pt-1 pr-1">Producción al crédito</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        @include('produccion.credito_venta')
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
        @include('produccion.comprobante')
        @include('produccion.etiqueta')
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/produccion.js')}}"></script>
@endsection
