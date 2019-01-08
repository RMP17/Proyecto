@extends('maquetas.admin')
@section('page_wrapper')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
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
                                   href="#nav-home" role="tab"
                                   aria-controls="nav-home"
                                   aria-selected="true">Comprar</a>
                                <a class="nav-item nav-link w-10em"
                                   id="nav-profile-tab"
                                   data-toggle="tab"
                                   href="#nav-proveedores"
                                   role="tab"
                                   aria-controls="nav-profile"
                                   aria-selected="false">Proveedores</a>
                                <a class="nav-item nav-link w-10em"
                                   id="nav-contact-tab"
                                   data-toggle="tab"
                                   href="#nav-contact"
                                   role="tab"
                                   aria-controls="nav-contact"
                                   aria-selected="false">Contactos</a>
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
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <div class="table-responsive">
                                        <table id="zero_config" class="table table-striped table-bordered">

                                            <thead>
                                            <tr>
                                                <th>Tipo de pago</th>
                                                <th>Codigo</th>
                                                <th>Fecha</th>
                                                <th>Sucursal</th>
                                                <th>Almacen</th>
                                                <th>Proveedor</th>
                                                <th>Costo Total</th>
                                                <th>Acciones</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            {{--@foreach($compras as $c)
                                                <tr>
                                                    <td>{{ $c -> tipo_pago }}</td>
                                                    <td>{{ $c -> codigo }}</td>
                                                    <td>{{ $c -> fecha_compra }}</td>
                                                    <td>{{ $c -> nombre_sucursal }}</td>
                                                    <td>{{ $c -> direccion_almacen }}</td>
                                                    <td>{{ $c -> razon_social_proveedor }}</td>
                                                    <td>{{ $c -> costo_total}}</td>

                                                    <td>

                                                    </td>
                                                </tr>
                                            @endforeach--}}
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                        {{--=========================================NAV TABCONTENT==========================--}}
                                        {{--=========================================TAP PROVEEDORES=========================--}}
                                <div class="tab-pane fade" id="nav-proveedores" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    @include('proveedor.index')
                                </div>
                                        {{--=========================================END TAP PROVEEDORES=====================--}}
                                        {{--=========================================END TAP PAISES==========================--}}
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    @include('contacto.index')
                                </div>
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
    <script src="{{asset('js/compra.js')}}"></script>
@endsection
