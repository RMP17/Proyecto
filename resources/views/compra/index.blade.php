@extends('maquetas.admin')
@section('page_wrapper')
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">

                <h4 class="page-title">Comprar</h4>
                <div class="col-3">
                    <a type="button" class="btn btn-outline-purple" href="{{url ('compra/create')}}">Registrar nuevo</a>
                </div>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Retornar a la página principal</li>
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
                        <h4 class="card-title">Compras</h4>
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
                                @foreach($compras as $c)
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
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{$compras -> render()}}
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
@endsection