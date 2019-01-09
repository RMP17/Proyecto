<a href data-target="#modal-registrar-empleado" data-toggle="modal"
   title="Nuevo Empleado">
    <button type="button" class="btn btn-outline-success btn-sm"><i
                class="fas fa-plus"></i></button>
</a>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>NIT / CI</th>
            <th>Sexo</th>
            <th>Edad</th>
            <th>Sucursal</th>
            <th>Teléfono</th>
            <th>Celular</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>Registrado en fecha</th>
            <th>P/Referencia</th>
            <th>T/Referencia</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        {{--@foreach($empleados as $e)
            <tr>
                <td>{{ $e -> nombre }}

                    @if($e->estatus=='A')

                        <span class="waves-effect waves-light btn btn-primary btn-sm">Activo</span>
                    @else
                        @if($e->estatus=='X')

                            <span class="waves-effect waves-light btn btn-danger btn-sm">Inactivo</span>

                        @endif
                    @endif
                </td>
                <td>{{ $e -> ci }}</td>
                @if ($e -> sexo == 'm')
                    <td>Masculino</td>
                @else
                    <td>Femenino</td>
                @endif
                <td>{{ ceil($e -> edad/365) -1 }}</td>
                <td>{{ $e -> sucursal }}</td>
                <td>{{ $e -> telefono }}</td>
                <td>{{ $e -> celular }}</td>
                <td>{{ $e -> correo }}</td>
                <td>{{ $e -> direccion }}</td>
                <td>{{ $e -> fecha_registro }}</td>
                <td>{{ $e -> persona_referencia }}</td>
                <td>{{ $e -> telefono_referencia }}</td>
                <td>
                    <a title="Editar" href="{{URL::action('EmpleadoControlador@edit', $e -> id_empleado)}}"><button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button></a>
                    <a title="Dar de baja" href="" data-target="#modal-delete-empleado-{{$e -> id_empleado}}" data-toggle="modal"><button type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-thumb-down"></i></button></a>

                    <!-- <button type="button" class="btn btn-dark btn-sm"><i class="mdi mdi-folder"></i></button >-->
                </td>
            </tr>
            @include('empleado.destroy')
        @endforeach--}}
        </tbody>
    </table>
</div>

{{--===============================================Modal New Empleado======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-registrar-empleado">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Nuevo Empleado</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                @include('empleado.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar</button>
            </div>
        </div>
    </div>
</div>