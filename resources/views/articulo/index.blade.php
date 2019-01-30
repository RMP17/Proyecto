@extends('maquetas.admin')
@section('page_wrapper')

    <div id="app-articulo">
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb pb-2">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Artículos</h4>
                    <div class="col-auto">
                        <a href="javascript:void(0);" v-if="!articulo.modeEdit"  class="btn btn-outline-dark w-10em" @click="articulo.modeCreate=!articulo.modeCreate">
                            <span  v-if="!articulo.modeCreate">Nuevo Artículo</span>
                            <span v-else>Lista de Artículos</span>
                        </a>
                        <a v-if="!articulo.modeEdit" href data-target="#modal-articulo" data-toggle="modal" class="btn btn-outline-dark w-10em">
                            Categorías
                        </a>
                        <a v-if="!articulo.modeEdit" href data-target="#modal-fabricante" data-toggle="modal" class="btn btn-outline-dark w-10em">
                            Fabricantes
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid de articulo  -->
        <!-- ============================================================== -->
        <div v-if="!articulo.modeCreate" class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-center mb-3">
                                <div class="col p-0">
                                    <div class="input-group">
                                        <div class="col-lg-4"><input
                                                    class="form-control"
                                                    @keydown.enter="getArticuloByCodigo($event)"
                                                    placeholder="Código" type="text"></div>
                                        <div class="col-lg-4"><input
                                                    class="form-control"
                                                    @keydown.enter="getArticuloByCodigoBarras($event)"
                                                    placeholder="Código de Barras" type="text"></div>
                                        <div class="col-lg-4">
                                            <app-online-suggestions :config="articulo.config"
                                                                    @selected-suggestion-event="getArticuloByNombre">
                                            </app-online-suggestions>
                                        </div>
                                    </div>
                                </div>
                                <button class="btn btn-outline-secondary" @click="getArticulos">Mostrar todo</button>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-sm table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Codigo</th>
                                        <th>Codigo de barra</th>
                                        <th>Características</th>
                                        <th>Precio Compra</th>
                                        <th>Precio Producción</th>
                                        <th>Categoría</th>
                                        <th>Fabricante</th>
                                        <th>Registrado en fecha</th>
                                        <th>Dimensiones</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="articulo in articulo.data">
                                            {{--articulo.data.estatus: Verde => Respresnta articulo activo; Gris => Respresnta articulo inactivo --}}
                                            {{--<td :class="articulo.data.estatus>0 ? 'bg-success text-white': 'bg-secondary text-white'" >--}}
                                            <td>
                                                @{{ articulo.nombre }}
                                                <br>
                                                <span v-if="!!articulo.estatus" class="badge badge-success">Disponible</span>
                                                <span v-else class="badge badge-secondary">No Disponible</span>
                                            </td>
                                            <td>@{{ articulo.codigo }}</td>
                                            <td>@{{ articulo.codigo_barra }}</td>
                                            <td>@{{ articulo.caracteristicas}}</td>
                                            <td>@{{ articulo.precio_compra }}</td>
                                            <td>@{{ articulo.precio_produccion }}</td>
                                            <td><span v-if="articulo.categoria">@{{ articulo.categoria.categoria }}</span></td>
                                            <td><span v-if="articulo.fabricante">@{{ articulo.fabricante.nombre }}</span></td>
                                            <td>@{{ articulo.fecha_registro }}</td>
                                            <td>
                                                Largo:@{{ articulo.dimensiones.largo }}<br>
                                                Ancho:@{{ articulo.dimensiones.ancho }} <br>
                                                Espesor:@{{ articulo.dimensiones.espesor }} <br>
                                                Volumen:@{{ articulo.dimensiones.volumen }} <br>
                                            </td>
                                            <td>
                                                <a type="button" href="javascript:void(0);"
                                                   title="Editar"
                                                   @click="changeToEditModeArticulo(articulo)"
                                                   class="btn btn-warning btn-sm">
                                                    <i class="mdi mdi-pencil"></i>
                                                </a>
                                                <a type="button"
                                                   title="Agregar precios de venta"
                                                   href="javascript:void(0);"
                                                   data-backdrop="static"
                                                   data-keyboad="false"
                                                   data-target="#modal-add-precio"
                                                   data-toggle="modal"
                                                   @click="selectArticulo(articulo)"
                                                   class="btn btn-info btn-sm"><i class="far fa-money-bill-alt"></i>
                                                </a>
                                                <a v-if="!!articulo.estatus" type="button" href="javascript:void(0);"
                                                   title="Dar de baja"
                                                   @click="changeStatusOfArticulo(articulo)"
                                                   class="btn btn-secondary btn-sm">
                                                    <i class="fas fa-chevron-down"></i>
                                                </a>
                                                <a v-else type="button" href="javascript:void(0);"
                                                   title="Habilitar artículo"
                                                   @click="changeStatusOfArticulo(articulo)"
                                                   class="btn btn-success btn-sm">
                                                    <i class="fas fa-chevron-up"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page Content -->
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
        <!--  Container fluid de articulo  -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Container fluid de articulo create  -->
        <!-- ============================================================== -->
        <div v-else >
            @include('articulo.create')
        </div>
        <!-- ============================================================== -->
        <!--  Container fluid de articulo create -->
        <!-- ============================================================== -->





        {{--===============================================Modal Articulos======================================--}}
        <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-articulo">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title pt-1 pr-1">Categorías</h4>
                        <a v-show="!categoria.modeEdit" href data-target="#modal-create-categoria"
                           data-toggle="modal"
                           class="btn btn-outline-dark w-10em"
                           @click="categoria.modeCreate=!categoria.modeCreate"
                        >
                            <span v-show="!categoria.modeCreate">Nueva</span>
                            <span v-show="categoria.modeCreate">Ver</span>
                        </a>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                        </button>
                    </div>
                    <div class="modal-body pt-0 pb-0">
                        <div v-if="!categoria.modeCreate">
                            @include('categoria.index')
                        </div>
                        <template v-else>
                            @include('categoria.create')
                        </template>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        {{--===============================================Modal Fabricante======================================--}}
        <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-fabricante">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title pt-1 pr-1">Fabricantes</h4>
                        <a v-show="!fabricante.modeEdit" href data-target="#modal-create-categoria"
                           data-toggle="modal"
                           class="btn btn-outline-dark w-10em"
                           @click="fabricante.modeCreate=!fabricante.modeCreate"
                        >
                            <span v-show="!fabricante.modeCreate">Nuevo</span>
                            <span v-show="fabricante.modeCreate">Ver</span>
                        </a>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                        </button>
                    </div>
                    <div class="modal-body pt-0 pb-0">
                        <div v-if="!fabricante.modeCreate">
                            @include('fabricante.index')
                        </div>
                        <template v-else>
                            @include('fabricante.create')
                        </template>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        {{--===============================================Modal Add Precios======================================--}}
        <div class="modal fade modal-slide-in-right"
             {{--@keydown.esc_="cancelModeEditCuentaProveedor"--}}
             aria-hidden="true" role="dialog" tabindex="-1" id="modal-add-precio">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title pt-1 pr-1">Precios @{{ articulosSucursales.articulo ?articulosSucursales.articulo.nombre:'' }}</h4>

                        <a v-show="!articulosSucursales.modeEdit" href
                           data-toggle="modal"
                           class="btn btn-outline-dark w-10em"
                           @click="articulosSucursales.modeCreate=!articulosSucursales.modeCreate"
                        >
                            <span v-show="!articulosSucursales.modeCreate">Nuevo</span>
                            <span v-show="articulosSucursales.modeCreate">Ver</span>
                        </a>
                        <button type="button" class="close"
                                {{--@click_="cancelModeEditCuentaProveedor"--}}
                                data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                        </button>
                    </div>
                    <div class="modal-body pb-0">
                        <div v-if="!articulosSucursales.modeCreate">
                            @include('articulo.precio.index')
                        </div>
                        <div v-else>
                            @include('articulo.precio.create')
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{asset('js/articulo.js')}}"></script>
@endsection