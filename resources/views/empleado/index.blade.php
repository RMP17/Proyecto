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
        <tr v-for="_empleado in empleado.data">
            <td>@{{ _empleado.nombre }} <br>
                <span v-if="!!_empleado.status" class="waves-effect waves-light btn btn-success btn-sm">Activo</span>
                <span v-else class="waves-effect waves-light btn btn-secondary btn-sm">Inactivo</span>
            </td>
            <td>@{{ _empleado.ci }}</td>
            <td>
                <span v-if="_empleado.sexo==='m'">Masculino</span>
                <span v-else>Femenino</span>
            </td>
            <td>@{{ _empleado.edad }}</td>
            <td>@{{ _empleado.sucursal.nombre }}</td>
            <td>@{{ _empleado.telefono }}</td>
            <td>@{{ _empleado.celular }}</td>
            <td>@{{ _empleado.correo }}</td>
            <td>@{{ _empleado.direccion }}</td>
            <td>@{{ _empleado.fecha_registro }}</td>
            <td>@{{ _empleado.persona_referencia }}</td>
            <td>@{{ _empleado.telefono_referencia }}</td>
            <td>
                <a href="javascript:void(0)"
                   title="Editar Empleado"
                   @click="modeEditEmpleado(_empleado)"
                   data-backdrop="static"
                   data-keyboad="false"
                   data-target="#modal-edit-empleado"
                   data-toggle="modal"
                   type="button" class="btn btn-warning btn-sm">
                    <i class="mdi mdi-pencil"></i>
                </a>
               {{-- <a title="Editar" href="{{URL::action('EmpleadoControlador@edit', $e -> id_empleado)}}">
                    <button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button>
                </a>
                <a title="Dar de baja" href="" data-target="#modal-delete-empleado-{{$e -> id_empleado}}"
                   data-toggle="modal">
                    <button type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-thumb-down"></i></button>
                </a>--}}
            </td>
        </tr>
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

{{--===============================================Modal Edit Empleado======================================--}}
<div class="modal fade modal-slide-in-right"
     @keydown.esc="cancelModeEditEmpleado"
     aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-empleado">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Editar Empleado</h4>
                <button type="button" class="close"
                        @click="cancelModeEditEmpleado"
                        data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                @include('empleado.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                        data-dismiss="modal" @click="cancelModeEditEmpleado" > Cerrar</button>
            </div>
        </div>
    </div>
</div>