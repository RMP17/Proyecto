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
                        <!-- <h4 class="card-title">Caja Chica</h4> -->
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>Estado</th>
                                    <th>Fecha de apertura</th>
                                    <th>Fecha de cierre</th>
                                    <th>Monto de apertura</th>
                                    <th>Monto de cierre</th>
                                    <th>Monto declarado</th>
                                    <th>Diferencia</th>
                                    <th>Observaciones</th>
                                    <th>Sucursal</th>
                                    <th>Empleado a cargo</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--@foreach($caja_chica as $c)
                                    <tr>
                                        @if($c->fecha_cierre==null)
                                            <td>
                                                <span class="waves-effect waves-light btn btn-primary btn-sm">Activa</span>
                                            </td>
                                            <td>{{ $c -> fecha_apertura }}</td>
                                            <td>{{ $c -> fecha_cierre }}</td>
                                            <td>{{ $c -> monto_apertura}}</td>
                                            <td>{{ $c -> monto_estado }}</td>
                                            <td>{{ $c -> monto_declarado }}</td>
                                            <td>Ninguno</td>
                                            <td>{{ $c -> observaciones }}</td>
                                            <td>{{ $c -> sucursal }}</td>
                                            <td>{{ $c -> empleado }}</td>
                                            <td>
                                                <a href="Editar Caja"
                                                   data-target="#modal-edit-caja_chica-{{$c -> id_caja_chica}}"
                                                   data-toggle="modal">
                                                    <button type="button" class="btn btn-warning btn-sm"><i
                                                                class="mdi mdi-pencil"></i></button>
                                                </a>
                                                <a href="Cerrar Caja"
                                                   data-target="#modal-close-caja_chica-{{$c -> id_caja_chica}}"
                                                   data-toggle="modal">
                                                    <button type="button" class="btn btn-danger btn-sm"><i
                                                                class="mdi mdi-delete-forever"></i></button>
                                                </a>
                                                <a title="Añadir gasto"
                                                   href="{{URL::action('GastoControlador@show', $c -> id_caja_chica)}}">
                                                    <button type="button" class="btn btn-dark btn-sm"><i
                                                                class="mdi mdi-plus-circle"></i></button>
                                                </a>
                                                <div>
                                                    <div>@include ('cajachica.edit')</div>
                                                </div>
                                                <div>
                                                    <div>@include ('cajachica.destroy')</div>
                                                </div>
                                            </td>
                                        @else
                                            <td><span class="waves-effect waves-light btn btn-default btn-sm"
                                                      style="background: red">Cerrada</span></td>
                                            <td>{{ $c -> fecha_apertura }}</td>
                                            <td>{{ $c -> fecha_cierre }}</td>
                                            <td>{{ $c -> monto_apertura}}</td>
                                            <td>{{ $c -> monto_estado }}</td>
                                            <td>{{ $c -> monto_declarado }}</td>
                                            <td>{{ $c -> monto_estado - $c -> monto_declarado }}</td>
                                            <td>{{ $c -> observaciones }}</td>
                                            <td>{{ $c -> sucursal }}</td>
                                            <td>{{ $c -> empleado }}</td>
                                        @endif
                                    </tr>
                                @endforeach--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
    <!-- ============================================================== -->
    @include('cajachica.create')