@extends('maquetas.admin')
@section('page_wrapper')
    <div>
        <!-- ============================================================== -->
        <!-- Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <div class="page-breadcrumb pb-2">
            <div class="row">
                <div class="col-12 d-flex no-block align-items-center">
                    <h4 class="page-title">Menu Principal</h4>
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
            <!-- Cajas de menú  -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <!-- Column -->
                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <a href="{{url ('venta')}}">
                                            <div class="box bg-success text-center">
                                                <h1 class="font-light text-white"><i class="mdi mdi-cart"></i></h1>
                                                <h6 class="text-white">Ventas</h6>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="box bg-cyan text-center">
                                            <h1 class="font-light text-white"><i class="mdi mdi-cart-outline"></i></h1>
                                            <h6 class="text-white">Compras</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <a href="{{url ('articulo')}}">
                                            <div class="box bg-orange text-center">
                                                <h1 class="font-light text-white"><i class="mdi mdi-cube"></i></h1>
                                                <h6 class="text-white">Artículos</h6>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <a href="{{url ('empleado')}}">
                                            <div class="box bg-dark text-center">
                                                <h1 class="font-light text-white"><i class="mdi mdi-contact-mail"></i></h1>
                                                <h6 class="text-white">Empleados</h6>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <a href="{{url ('cliente')}}">
                                            <div class="box bg-purple text-center">
                                                <h1 class="font-light text-white"><i class="mdi mdi-contacts"></i></h1>
                                                <h6 class="text-white">Clientes</h6>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <a href="{{url('cajachica')}}">
                                            <div class="box bg-danger text-center">
                                                <h1 class="font-light text-white"><i class="mdi mdi-square-inc-cash"></i></h1>
                                                <h6 class="text-white">Caja chica</h6>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="box bg-warning text-center">
                                            <h1 class="font-light text-white"><i class="mdi mdi-file-document-box"></i></h1>
                                            <h6 class="text-white">Facturación</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="box bg-theme text-center">
                                            <h1 class="font-light text-white"><i class="mdi mdi-credit-card-multiple"></i></h1>
                                            <h6 class="text-white">Transacciones</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="box bg-teal text-center">
                                            <h1 class="font-light text-white"><i class="mdi mdi-calculator"></i></h1>
                                            <h6 class="text-white">Mediciones</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="box bg-indigo text-center">
                                            <h1 class="font-light text-white"><i class="mdi mdi-database"></i></h1>
                                            <h6 class="text-white">Copia de seguridad</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                                <div class="col-md-6 col-lg-2 col-xlg-3">
                                    <div class="card card-hover">
                                        <div class="box bg-secondary text-center">
                                            <h1 class="font-light text-white"><i class="mdi mdi-wrench"></i></h1>
                                            <h6 class="text-white">Configuraciones</h6>
                                        </div>
                                    </div>
                                </div>
                                <!-- Column -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Cajas de menú  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Cajas estadísticas -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-md-flex align-items-center">
                                <div>
                                    <h4 class="card-title">Sucursal </h4>
                                    <h5 class="card-subtitle">Estadísticas :</h5>
                                </div>
                            </div>
                            <!--- estadística -->
                            <div class="card-body">
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="bg-dark p-10 text-white text-center">
                                                <i class="fa fa-user m-b-5 font-16"></i>
                                                <h5 class="m-b-0 m-t-5">2540</h5>
                                                <small class="font-light">Ventas</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--- estadística -->
                            <div class="card-body">
                                <div class="col-lg-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="bg-dark p-10 text-white text-center">
                                                <i class="fa fa-user m-b-5 font-16"></i>
                                                <h5 class="m-b-0 m-t-5">2540</h5>
                                                <small class="font-light">Total Users</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--- estadística -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Cajas estadísticas -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Container fluid  -->
        <!-- ============================================================== -->
    </div>

@endsection