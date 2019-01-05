@extends('maquetas.admin')
@section('page_wrapper')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div id="app-config">
        <div class="page-breadcrumb mb-2">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Configuraciones</h4>
                    <div class="col-auto">
                        {{--<a type="button" class="btn btn-outline-purple" href="{{url ('compra/create')}}">Registrar nuevo</a>
                        <a href="#" type="button" class="btn btn-outline-dark w-10em">
                            <span>Proveedores</span>
                        </a>--}}
                        <nav>
                            <div class="nav nav-tabs show active" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link w-10em active"
                                   id="nav-profile-tab"
                                   data-toggle="tab"
                                   href="#nav-config"
                                   role="tab"
                                   aria-controls="nav-profile"
                                   aria-selected="false">Datos Iniciales</a>
                                <a class="nav-item nav-link w-10em"
                                   id="nav-profile-tab"
                                   data-toggle="tab"
                                   href="#nav-paises"
                                   role="tab"
                                   aria-controls="nav-profile"
                                   aria-selected="false">Países</a>
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
                                        {{--=========================================TAP CONFIG==========================--}}
                                <div class="tab-pane fade show active" id="nav-config" role="tabpanel"
                                     aria-labelledby="nav-profile-tab">
                                    <div class="container-fluid">
                                        <div class="card-group mb-0 ">
                                            <div class="card">
                                                <div class="card-body pl-0">
                                                    <h5 class="card-title text-center">Registro de Monedas</h5>
                                                    @include('moneda.index')
                                                </div>
                                            </div>
                                            <div class="card">
                                                <div class="card-body pr-0">
                                                    <h5 class="card-title text-center">Registro de Cargos</h5>
                                                    @include('cargo.index')
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        {{--=========================================END TAP CONFIG==========================--}}
                                        {{--=========================================END TAP PAISES==========================--}}
                                <div class="tab-pane fade" id="nav-paises" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    @include('pais.index')
                                </div>
                                        {{--=================================================END NAV PAISES==================================--}}
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                    ...dddddddddddddd
                                    ...dddddddddddddd
                                    ...dddddddddddddd
                                    ...dddddddddddddd
                                    ...dddddddddddddd
                                    ...dddddddddddddd
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
    <script src="{{asset('js/config.js')}}"></script>
@endsection