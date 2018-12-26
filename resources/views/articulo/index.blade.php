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
                        <a href="#" class="btn btn-outline-dark w-10em" @click="articulo.modeCreate=!articulo.modeCreate">
                            <span  v-if="!articulo.modeCreate">Nuevo Artículo</span>
                            <span v-else>Lista de Artículos</span>
                        </a>
                        <a href data-target="#modal-articulo" data-toggle="modal" class="btn btn-outline-dark w-10em">
                            Categorías
                        </a>
                        <a href data-target="#modal-fabricante" data-toggle="modal" class="btn btn-outline-dark w-10em">
                            Fabricantes
                        </a>
                    </div>
                    <div class="ml-auto text-right">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{url('')}}">Inicio</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Retornar a la página principal
                                </li>
                            </ol>
                        </nav>
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
                            <h5 class="card-title">Artículos</h5>
                            <div class="table-responsive">
                                <table id="zero_config" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>Nombre-</th>
                                        <th>Codigo</th>
                                        <th>Codigo de barra</th>
                                        <th>Características</th>
                                        <th>Imagen</th>
                                        <th>Subcategoría</th>
                                        <th>Fabricante</th>
                                        <th>Registrado en fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    {{--<tbody>
                                    @foreach($articulos as $a)
                                        <tr>
                                            <td>{{ $a -> nombre }}</td>
                                            <td>{{ $a -> codigo }}</td>
                                            <td>{{ $a -> codigo_barra }}</td>
                                            <td>{{ $a -> caracteristicas}}</td>
                                            <td>{{ $a -> imagen }}</td>
                                            <td>{{ $a -> subcategoria }}</td>
                                            <td>{{ $a -> fabricante }}</td>
                                            <td>{{ $a -> fecha_registro }}</td>
                                            <td>
                                                <a href="{{URL::action('ArticuloControlador@edit', $a -> id_articulo)}}"
                                                   title="Editar">
                                                    <button type="button" class="btn btn-warning btn-sm"><i
                                                                class="mdi mdi-pencil"></i></button>
                                                </a>
                                                <a href="" data-target="#modal-delete-articulo-{{$a -> id_articulo}}"
                                                   data-toggle="modal" title="Eliminar">
                                                    <button type="button" class="btn btn-danger btn-sm"><i
                                                                class="mdi mdi-thumb-down"></i></button>
                                                </a>
                                            </td>
                                        </tr>
                                        @include('articulo.destroy')
                                    @endforeach
                                    </tbody>--}}
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
    </div>

@endsection
@section('scripts')
    <script src="{{asset('js/articulo.js')}}"></script>
@endsection