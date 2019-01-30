<a href data-target="#modal-registrar-empleado" data-toggle="modal"
   title="Nuevo Empleado">
    <button type="button" class="btn btn-outline-success btn-sm"><i
                class="fas fa-plus"></i></button>
</a>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <td>Nombre</td>
            <td>NIT / CI</td>
            <td>Sexo</td>
            <td>Edad</td>
            <td>Almacén</td>
            <td>Teléfono</td>
            <td>Celular</td>
            <td>Correo</td>
            <td>Dirección</td>
            <td>P/Referencia</td>
            <td>T/Referencia</td>
            <td>Acciones</td>
        </tr>
        </thead>
        <tbody>
        <tr v-for="_empleado in empleado.data">
            <td>@{{ _empleado.nombre }} <br>
                <span v-if="!!_empleado.estatus" class="waves-effect waves-light btn btn-success btn-sm">Activo</span>
                <span v-else class="waves-effect waves-light btn btn-secondary btn-sm">Inactivo</span>
            </td>
            <td>@{{ _empleado.ci }}</td>
            <td>
                <span v-if="_empleado.sexo==='m'">Masculino</span>
                <span v-else>Femenino</span>
            </td>
            <td>@{{ _empleado.edad }}</td>
            <td>@{{ _empleado.almacen.codigo }}</td>
            <td>@{{ _empleado.telefono }}</td>
            <td>@{{ _empleado.celular }}</td>
            <td>@{{ _empleado.correo }}</td>
            <td>@{{ _empleado.direccion }}</td>
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
                <a href="javascript:void(0)"
                   title="Ver Kardex"
                   @click="getKardex(_empleado)"
                   data-backdrop="static"
                   data-keyboad="false"
                   data-target="#modal-kardex"
                   data-toggle="modal"
                   type="button" class="btn btn-info btn-sm">
                    <i class="far fa-file-alt"></i>
                </a>
                <a href="javascript:void(0)"
                   title="Ver Kardex"
                   @click="getAccesoOf(_empleado)"
                   data-backdrop="static"
                   data-keyboad="false"
                   data-target="#modal-add-acceso"
                   data-toggle="modal"
                   type="button" class="btn btn-info btn-sm">
                    <i class="far fa-user-circle fa-lg"></i>
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

{{--===============================================Modal Kardex======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-2" id="modal-kardex">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Kardex de @{{kardex.empleado.nombre}}</h4>
                <button v-if="kardex.currentTab===10" type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
                <a v-else href="javascript:void(0)"
                   title="Atras"
                   @click="changeTab(kardex.currentTab - 1)"
                   class="text-secondary">
                    <i class="fas fa-arrow-left fa-2x"></i>
                </a>
            </div>
            <div class="modal-body pb-0">
                <div v-if="kardex.currentTab === 10">@include('kardex.index')</div>
                <div v-if="kardex.currentTab === 11">@include('kardex.kardex_observaciones.show')</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="forceClosedModelKardex"> Cerrar</button>
            </div>
        </div>
    </div>
</div>

{{--===============================================Modal add Acceso ======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-2" id="modal-add-acceso">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Acceso de @{{acceso.empleado.nombre}}</h4>
                <button v-if="acceso.currentTab===10" type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
                <a v-else href="javascript:void(0)"
                   title="Atras"
                   @click="changeTab(acceso.currentTab - 1)"
                   class="text-secondary">
                    <i class="fas fa-arrow-left fa-2x"></i>
                </a>
            </div>
            <div class="modal-body pb-0">
                <div v-if="acceso.currentTab === 10">@include('acceso.index')</div>
                {{--<div v-if="acceso.currentTab === 11">@include('kardex.kardex_observaciones.show')</div>--}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="forceClosedModelKardex"> Cerrar</button>
            </div>
        </div>
    </div>
</div>
