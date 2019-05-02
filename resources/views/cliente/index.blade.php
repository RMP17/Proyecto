@extends('maquetas.admin')
@section('page_wrapper')
    <div id="app-cliente">
        <div class="page-breadcrumb mb-2">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Clientes</h4>
                    <div class="col-auto">
                        {{--<nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link w-10em active"
                                   id="nav-home-tab" data-toggle="tab"
                                   href="#nav-clientes" role="tab"
                                   aria-controls="nav-clientes"
                                   aria-selected="true">Clientes</a>
                                <a title="Registro de Ventas" class="nav-item nav-link w-10em"
                                   id="nav-profile-tab"
                                   data-toggle="tab"
                                   href="#nav-registro-ventas"
                                   role="tab"
                                   aria-controls="nav-register-venta"
                                   aria-selected="false">R. de Ventas</a>
                            </div>
                        </nav>--}}
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
                                <div class="tab-pane fade show active" id="nav-clientes" role="tabpanel"
                                     aria-labelledby="nav-clientes-tab">
                                    <div class="row mb-3">
                                        <div class="col-md-8 offset-2 pr-5 pl-5">
                                            <app-dates @date-range="getClientesByRageDate"></app-dates>
                                        </div>
                                    </div>
                                    <div class="d-md-flex flex-row">
                                        <div>
                                            <a href="javascript:void(0)"
                                               title="Nuevo Cliente"
                                               data-backdrop="static"
                                               data-keyboad="false"
                                               data-target="#modal-new-client"
                                               data-toggle="modal"
                                               class="btn btn-outline-success"
                                            ><i class="fas fa-plus"></i>
                                            </a>
                                        </div>
                                        <div v-if="!cliente.hideFilters" class="col p-0">
                                            <app-online-suggestions-objects :config="configCliente"
                                                                            @selected-suggestion-event="filterByCliente">
                                            </app-online-suggestions-objects>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="input-group">
                                               {{-- <a href="javascript:void(0);" type="button"
                                                   title="Límpiar filtros"
                                                   class="btn btn-outline-secondary"
                                                   @click="removeFilters"
                                                ><i class="fas fa-ban fa-lg"></i>
                                                </a>--}}
                                                {{--<a href="javascript:void(0);" type="button"
                                                   title="Exportar a PDF"
                                                   @click="exportPdf"
                                                   class="btn btn-outline-danger"
                                                ><i class="far fa-file-pdf fa-lg"></i>
                                                </a>--}}
                                                <a href="javascript:void(0);" type="button"
                                                   title="Átras"
                                                   class="btn btn-outline-secondary"
                                                   :class="cliente.paginated.pageNumber === 0 ? 'disabled':''"
                                                   @click="prevPage"
                                                ><i class="fas fa-arrow-left fa-lg"></i>
                                                </a>
                                                <div class="input-group-prepend">
                                                <span title="Página actual" class="input-group-text">
                                                @{{ cliente.paginated.pageNumber+1 }}
                                                </span>
                                                </div>

                                                <a href="javascript:void(0);" type="button"
                                                   title="Siguiente"
                                                   class="btn btn-outline-secondary"
                                                   :class="cliente.paginated.pageNumber >= pageCount -1 ? 'disabled':''"
                                                   @click="nextPage"
                                                ><i class="fas fa-arrow-right fa-lg"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="zero_config" class="table table-striped table-bordered table-sm">
                                            <thead>
                                            <tr>
                                                <th>Razón social</th>
                                                <th>NIT/CI</th>
                                                <th>Actividad</th>
                                                <th>Teléfono</th>
                                                <th>Celular</th>
                                                <th>Correo</th>
                                                <th>Dirección</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            {{--<tbody>
                                            @foreach($clientes as $c)
                                                @if($c -> id_cliente > 1)
                                                    <tr>
                                                        <td>{{ $c -> razon_social }}</td>
                                                        <td>{{ $c -> nit }}</td>
                                                        <td>{{ $c -> actividad }}</td>
                                                        <td>{{ $c -> telefono }}</td>
                                                        <td>{{ $c -> celular }}</td>
                                                        <td>{{ $c -> correo }}</td>
                                                        <td>{{ $c -> direccion }}</td>
                                                        <td>
                                                            <a href="{{URL::action('ClienteControlador@edit',$c->id_cliente)}}">
                                                                <button type="button" class="btn btn-warning btn-sm"><i
                                                                            class="mdi mdi-pencil"></i></button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @endforeach
                                            </tbody>--}}
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
        {{--===============================================Modal New Client======================================--}}
        <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1"
             id="modal-new-client">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title pt-1 pr-1">Nuevo Cliente</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        {{--@include('cliente.create')--}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">
                            Cerrar
                        </button>
                    </div>
                </div>
            </div>
        </div>
        {{--===============================================Modal View Detail Venta======================================--}}
        {{--<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1"
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
        </div>--}}
    </div>
@endsection
@section('scripts')
    <script src="{{asset('js/cliente.js')}}"></script>
@endsection

{{--<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Clientes</h4>
                    <div class="table-responsive">
                        <table id="zero_config" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Razón social</th>
                                <th>NIT/CI</th>
                                <th>Actividad</th>
                                <th>Teléfono</th>
                                <th>Celular</th>
                                <th>Correo</th>
                                <th>Dirección</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clientes as $c)
                                @if($c -> id_cliente > 1)
                                    <tr>
                                        <td>{{ $c -> razon_social }}</td>
                                        <td>{{ $c -> nit }}</td>
                                        <td>{{ $c -> actividad }}</td>
                                        <td>{{ $c -> telefono }}</td>
                                        <td>{{ $c -> celular }}</td>
                                        <td>{{ $c -> correo }}</td>
                                        <td>{{ $c -> direccion }}</td>
                                        <td>
                                            <a href="{{URL::action('ClienteControlador@edit',$c->id_cliente)}}">
                                                <button type="button" class="btn btn-warning btn-sm"><i
                                                            class="mdi mdi-pencil"></i></button>
                                            </a>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{$clientes -> render()}}
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
</div>--}}

