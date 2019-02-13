@extends('maquetas.admin')
@section('page_wrapper')
    <div id="app-medicion">
        <div class="page-breadcrumb mb-2">
            <div class="row">
                <div class="d-flex no-block align-items-center">
                    <h4 class="page-title">Mediciones</h4>
                    <div class="col">
                        <nav>
                            <div class="nav nav-tabs show active" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link w-10em active"
                                   id="nav-profile-tab"
                                   data-toggle="tab"
                                   href="#nav-movimientos-tab"
                                   role="tab"
                                   aria-controls="nav-profile"
                                   aria-selected="false">Medir</a>
                                <a class="nav-item nav-link w-10em"
                                   id="nav-registro-movimientoalmacen"
                                   title="Registro de Medición"
                                   data-toggle="tab"
                                   href="#nav-registro-movimientoalmacen-tab"
                                   role="tab"
                                   aria-selected="false">R. Mediciones</a>
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
                                {{--=========================================TAP REGISTRO DE MEDICIONES==========================--}}
                                <div class="tab-pane fade show active" id="nav-movimientos-tab" role="tabpanel"
                                     aria-labelledby="nav-contact-tab">
                                    <div class="container-fluid pr-0 pl-0">
                                        <div class="card-group mb-0 ">
                                            <div class="card col-md-8 p-0">
                                                <div class="card-body p-0">
                                                    <h5 class="card-title text-center">Detalle</h5>
                                                    @include('mediciones.detalle')
                                                </div>
                                            </div>
                                            <div class="card col-md-4 border-0 pr-0 pl-0">
                                                <div class="card-body p-0">
                                                    <h5 class="card-title text-center">Datos del Cliente</h5>
                                                    @include('mediciones.create')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--=========================================END TAP REGISTRO DE MEDICIONES==================================--}}
                                {{--=========================================TAP Registro de Mediciones==========================--}}
                                <div class="tab-pane fade" id="nav-registro-movimientoalmacen-tab" role="tabpanel"
                                     aria-labelledby="nav-profile-tab">
                                    <div class="row mb-3">
                                        <div class="col-md-8 offset-2 pr-5 pl-5">
                                            <app-dates @date-range="getMedicionesByRageDate"></app-dates>
                                        </div>
                                    </div>
                                    <div class="d-md-flex flex-row">
                                        <template v-if="!medicion.hideFilters">
                                            <div>
                                                <app-online-suggestions-objects :config="configEmpleado"
                                                                                @selected-suggestion-event="filterByEmpleado">
                                                </app-online-suggestions-objects>
                                            </div>
                                            <div>
                                                <app-online-suggestions-objects :config="configCliente"
                                                                                @selected-suggestion-event="filterByCliente">
                                                </app-online-suggestions-objects>
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
                                                   :class="medicion.paginated.pageNumber === 0 ? 'disabled':''"
                                                   @click="prevPage"
                                                ><i class="fas fa-arrow-left fa-lg"></i></a>
                                                <div class="input-group-prepend">
                                                    <span title="Página actual"
                                                          class="input-group-text"
                                                    >@{{ medicion.paginated.pageNumber + 1 }}</span>
                                                </div>
                                                <a href="javascript:void(0);" type="button"
                                                   title="Siguiente"
                                                   class="btn btn-outline-secondary"
                                                   :class="medicion.paginated.pageNumber >= pageCount -1 ? 'disabled':''"
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
                                                <th>Cliente</th>
                                                <th>Fecha y hora de visita</th>
                                                <th>Direcciòn</th>
                                                <th>Descripcion de la Direcciòn</th>
                                                <th>Observaciones</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="(medicion, index) in paginatedData" :class="medicion.status==='mc' ? 'table-danger':''">
                                                <td>@{{ medicion.empleado }}</td>
                                                <td>@{{ medicion.cliente }}</td>
                                                <td>@{{ medicion.fecha_visita }}</td>
                                                <td>@{{ medicion.direccion }}</td>
                                                <td>@{{ medicion.descripcion_direccion }}</td>
                                                <td>@{{ medicion.observaciones }}</td>
                                                <td>
                                                    <a href="javascript:void(0)"
                                                       title="Ver detalle"
                                                       @click="viewDetallesMedicion(medicion)"
                                                       data-target="#modal-view-detail-medicion"
                                                       data-toggle="modal"
                                                       type="button" class="btn btn-outline-info btn-sm">
                                                        <i class="fas fa-eye fa-lg"></i>
                                                    </a>
                                                    <a href="javascript:void(0)"
                                                       title="Imprimir"
                                                       @click="printDetallesMedicion(medicion)"
                                                       type="button" class="btn btn-outline-info btn-sm lh-1">
                                                        <i class="mdi mdi-printer mdi-18px"></i>
                                                    </a>
                                                    <a v-if="medicion.status==='null' || medicion.status!=='mc'"
                                                       href="javascript:void(0)"
                                                       title="Anular Venta"
                                                       @click="removeMedicion(medicion, index)"
                                                       type="button" class="btn btn-outline-danger btn-sm">
                                                        <i class="fas fa-trash fa-lg"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        <table v-show="false" id="print-medicion">
                                            <thead>
                                            <tr>
                                                <th>Empleado</th>
                                                <th>Cliente</th>
                                                <th>Fecha y hora de visita</th>
                                                <th>Direcciòn</th>
                                                <th>Descripcion de la Direcciòn</th>
                                                <th>Observaciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr v-for="medicion in paginatedData">
                                                <td>@{{ medicion.empleado }}</td>
                                                <td>@{{ medicion.cliente }}</td>
                                                <td>@{{ medicion.fecha_visita }}</td>
                                                <td>@{{ medicion.direccion }}</td>
                                                <td>@{{ medicion.descripcion_direccion }}</td>
                                                <td>@{{ medicion.observaciones }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                {{--=========================================END TAP Registro Medicion==========================--}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--===============================================Modal View Detail Movimiento======================================--}}
        <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1"
             id="modal-view-detail-medicion">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title pt-1 pr-1">Detalle de @{{ medicion.oneMedicion ? medicion.oneMedicion.cliente:'' }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        @include('mediciones.show_detalle')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>

        @include('mediciones.comprobante')
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/mediciones.js')}}"></script>
@endsection
