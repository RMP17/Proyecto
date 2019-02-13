@extends('maquetas.admin')
@section('page_wrapper')
    <script type="text/javascript">
        var movimientos_almacenes_php = JSON.parse('<?/*= $var; */?>');
    </script>
    <div id="app-movimiento-almacen">
        <div class="page-breadcrumb mb-2">
            <div class="row">
                <div class="d-flex no-block align-items-center">
                    <h4 class="page-title">Movimientos de artículos</h4>
                    <div class="col">
                        <nav>
                            <div class="nav nav-tabs show active" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link w-10em active"
                                   id="nav-profile-tab"
                                   data-toggle="tab"
                                   href="#nav-movimientos-tab"
                                   role="tab"
                                   aria-controls="nav-movimientos"
                                   title="Nuevo Movimiento"
                                   aria-selected="false">N. Movimiento</a>
                                <a class="nav-item nav-link w-10em"
                                   id="nav-registro-movimientoalmacen"
                                   title="Registro de movimientos entre almacenes"
                                   data-toggle="tab"
                                   href="#nav-registro-movimientoalmacen-tab"
                                   role="tab"
                                   aria-selected="false">R. Mov. almacén</a>
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
                                {{--=========================================TAP REGISTRO movimientos almacen==========================--}}
                                <div class="tab-pane fade show active" id="nav-movimientos-tab" role="tabpanel"
                                     aria-labelledby="nav-contact-tab">
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
                                {{--=========================================END TAP REGISTRO de  movimientos almacen==================================--}}
                                {{--=========================================TAP Registro de Movimientos==========================--}}
                                <div class="tab-pane fade" id="nav-registro-movimientoalmacen-tab" role="tabpanel"
                                     aria-labelledby="nav-profile-tab">
                                    <div class="row mb-3">
                                        <div class="col-md-8 offset-2 pr-5 pl-5">
                                            <app-dates @date-range="getMovimientoAlmacenByRageDate"></app-dates>
                                        </div>
                                    </div>
                                    <div class="d-md-flex flex-row">
                                        <template v-if="!movimiento_almacen.hideFilters">
                                            <div>
                                                <app-online-suggestions-objects :config="configEmpleado"
                                                                                @selected-suggestion-event="filterByEmpleado">
                                                </app-online-suggestions-objects>
                                            </div>
                                            <div>
                                                <select class="custom-select"
                                                        @change="filterByAlmacenOrigen"
                                                        name="cbxFilterAlmacenOrigen">
                                                    <option :value="null" disabled selected>Seleccione Almacén origen
                                                    </option>
                                                    <option v-for="_almacen in almacenes" :value="_almacen.id_almacen">
                                                        @{{ _almacen.codigo }}
                                                    </option>
                                                </select>
                                            </div>
                                            <div>
                                                <select class="custom-select"
                                                        @change="filterByAlmacenDestino"
                                                        name="slctFilterAlmacenDestino">
                                                    <option :value="null" disabled selected>Seleccione Almacén destino
                                                    </option>
                                                    <option v-for="_almacen in almacenes" :value="_almacen.id_almacen">
                                                        @{{ _almacen.codigo }}
                                                    </option>
                                                </select>
                                            </div>
                                        </template>
                                        <div class="ml-auto">
                                            <div class="input-group">
                                                <a href="javascript:void(0);" type="button"
                                                   title="Límpiar filtros"
                                                   class="btn btn-outline-secondary"
                                                   @click="removeFilters"
                                                ><i class="fas fa-ban fa-lg"></i></a>
                                                <a href="javascript:void(0);" type="button"
                                                   title="Exportar a PDF"
                                                   @click="exportPdf"
                                                   class="btn btn-outline-danger"
                                                ><i class="far fa-file-pdf fa-lg"></i></a>
                                                <a href="javascript:void(0);" type="button"
                                                   title="Átras"
                                                   class="btn btn-outline-secondary"
                                                   :class="movimiento_almacen.paginated.pageNumber === 0 ? 'disabled':''"
                                                   @click="prevPage"
                                                ><i class="fas fa-arrow-left fa-lg"></i></a>
                                                <div class="input-group-prepend">
                                                    <span title="Página actual"
                                                          class="input-group-text"
                                                    >@{{ movimiento_almacen.paginated.pageNumber + 1 }}</span>
                                                </div>
                                                <a href="javascript:void(0);" type="button"
                                                   title="Siguiente"
                                                   class="btn btn-outline-secondary"
                                                   :class="movimiento_almacen.paginated.pageNumber >= pageCount -1 ? 'disabled':''"
                                                   @click="nextPage"
                                                ><i class="fas fa-arrow-right fa-lg"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive" >
                                        <table class="table table-striped table-bordered table-sm">
                                            <thead>
                                            <tr>
                                                <th>Empleado</th>
                                                <th>Fecha y hora</th>
                                                <th>Almacen Origen</th>
                                                <th>Almacen Destino</th>
                                                <th>Observaciones</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="_movimiento in paginatedData" :class="_movimiento.status==='mc' ? 'table-danger':''">
                                                <td>@{{ _movimiento.empleado }}</td>
                                                <td>@{{ _movimiento.fecha }}</td>
                                                <td>@{{ _movimiento.almacen_origen }}</td>
                                                <td>@{{ _movimiento.almacen_destino }}</td>
                                                <td>@{{ _movimiento.observaciones }}</td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                       title="Ver detalle"
                                                       @click="viewDetallesMovimientoAlmacen(_movimiento)"
                                                       data-target="#modal-view-detail-movimiento"
                                                       data-toggle="modal"
                                                       type="button" class="btn btn-outline-info btn-sm">
                                                        <i class="fas fa-eye fa-lg"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                       title="Imprimir"
                                                       @click="printDetallesMovimientoAlmacen(_movimiento)"
                                                       type="button" class="btn btn-outline-info btn-sm lh-1">
                                                        <i class="mdi mdi-printer mdi-18px"></i>
                                                    </a>
                                                    <a v-if="_movimiento.status==='null' || _movimiento.status!=='mc'"
                                                       href="javascript:void(0)"
                                                       title="Anular Venta"
                                                       @click="cancelComprovante(_movimiento)"
                                                       type="button" class="btn btn-outline-danger btn-sm">
                                                        <i class="far fa-trash-alt fa-lg"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table v-show="false" id="print-movimientos">
                                            <thead>
                                            <tr>
                                                <th>Empleado</th>
                                                <th>Fecha y hora</th>
                                                <th>Almacen Origen</th>
                                                <th>Almacen Destino</th>
                                                <th>Observaciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="_movimiento in paginatedData">
                                                <td>@{{ _movimiento.empleado }}</td>
                                                <td>@{{ _movimiento.fecha }}</td>
                                                <td>@{{ _movimiento.almacen_origen }}</td>
                                                <td>@{{ _movimiento.almacen_destino }}</td>
                                                <td>@{{ _movimiento.observaciones }}</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                {{--=========================================END TAP CAJA==========================--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--===============================================Modal View Detail Movimiento======================================--}}
        <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1"
             id="modal-view-detail-movimiento">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title pt-1 pr-1">Detalle</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        @include('movimientos_almacen.show_detalle')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @include('movimientos_almacen.comprobante')
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/movimientos_almacen.js')}}"></script>
@endsection
