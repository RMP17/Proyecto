@extends('maquetas.admin')
@section('page_wrapper')

    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Lista de empresas</h4>
                <div class="col-3">
                    <a type="button" class="btn btn-outline-dark" href="{{url ('empresa/create')}}">Registrar nueva</a>
                </div>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{url('')}}">Inicio</a></li>
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
                        <h4 class="card-title">Empresas</h4>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Razón social</th>
                                    <th scope="col">NIT</th>
                                    <th scope="col">Propietario</th>
                                    <th scope="col">Actividad</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $i = 0; ?>
                                @foreach($empresas as $e)
                                    <tr>
                                        @if ($e -> id_empresa > 1)
                                            <th scope="row">{{$i}}</th>
                                            <td>{{ $e -> razon_social }}</td>
                                            <td>{{ $e -> nit }}</td>
                                            <td>{{ $e -> propietario }}</td>
                                            <td>{{ $e -> actividad }}</td>
                                            <td>
                                                <a title="Editar"
                                                   href="{{URL::action('EmpresaControlador@edit',$e->id_empresa)}}"
                                                   type="submit" class="btn btn-warning btn-sm"> <i
                                                            class="mdi mdi-pencil"></i></a>
                                                <a title="Sucursales"
                                                   href="{{URL::action('SucursalControlador@show',$e->id_empresa)}}"
                                                   type="submit" class="btn btn-sm"><img style="width: 19px"
                                                                                         src="{{asset('nihil/imagenes/store2.png')}}"></a>
                                                <a title="Cuenta Bancaria"
                                                   href="{{URL::action('CuentaControlador@show',$e->id_empresa)}}"
                                                   type="submit" class="btn btn-primary btn-sm"><i
                                                            class="fab fa-cc-visa"></i></a>
                                            </td>
                                        @endif
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{$empresas -> render()}}
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