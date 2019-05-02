
<div class="d-flex bd-highlight">
    <div class="mr-auto">
        <a href data-target="#modal-registro-proveedor" data-toggle="modal"
                                             title="Nueva Moneda">
            <button type="button" class="btn btn-outline-success btn-sm"><i class="fas fa-user"></i></button>
        </a>
    </div>

</div>
<div class="table-responsive">
    <table class="table table-sm table-striped table-bordered">
        <thead>
        <tr>
            <th>Razón Social <br>NIT / CI</th>
            <th>Ciudad</th>
            <th>Teléfono <br>Celular</th>
            <th>Correo <br>Sitio Web </th>
            <th>Dirección</th>
            <th>Rubro</th>
            <th>Cuentas</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="_proveedor in proveedor.data">
            <td>
                @{{ _proveedor.razon_social }} <br>
                @{{ _proveedor.nit }}
            </td>
            <td>@{{ _proveedor.ciudad ? _proveedor.ciudad.pais_ciudad: '' }}</td>
            <td>
                @{{ _proveedor.telefono }} <br v-if="_proveedor.telefono">
                @{{ _proveedor.celular }}
            </td>
            <td>
                @{{ _proveedor.correo }} <br v-if="_proveedor.correo">
                @{{ _proveedor.sitio_web}}
            </td>
            <td>@{{ _proveedor.direccion }}</td>
            <td>@{{ _proveedor.rubro }}</td>
            <td>
                <span v-for="(_cuentasProveedor, index) in _proveedor.cuentasProveedor">
                    @{{ _cuentasProveedor.entidad }} <br v-if="_cuentasProveedor.entidad">
                    @{{ _cuentasProveedor.nro_cuenta }}<hr class="m-0 bg-dark" v-if="_proveedor.cuentasProveedor.length > index+1">
                </span>
            </td>
            <td>
                <a href="javascript:void(0)"
                   title="Editar Proveedor"
                   @click="modeEditProveedor(_proveedor)"
                   data-backdrop="static"
                   data-keyboard="false"
                   data-target="#modal-edit-proveedor"
                   data-toggle="modal"
                   type="button" class="btn btn-warning btn-sm">
                    <i class="mdi mdi-pencil"></i>
                </a>
                <a href="javascript:void(0)"
                   title="Ver Cuentas"
                   data-backdrop="static"
                   data-keyboard="false"
                   @click="assignProveedor(_proveedor)"
                   data-target="#modal-add-cuenta-banco"
                   data-toggle="modal"
                   type="button" class="btn btn-info btn-sm">
                    <i class="fas fa-credit-card"></i>
                </a>
                <a href="javascript:void(0)"
                   title="Ver Contactos"
                   data-backdrop="static"
                   data-keyboard="false"
                   @click="getContactoProveedor(_proveedor)"
                   data-target="#modal-contacto"
                   data-toggle="modal"
                   type="button" class="btn btn-info btn-sm btn-sm-icon">
                    <i class="far fa-address-card fa-2x"></i>
                </a>
                {{--<a href="{{URL::action('ProveedorControlador@edit', $p -> id_proveedor)}}">
                    <button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button>
                </a>
                <a href="" data-target="#modal-delete-{{$p->id_proveedor}}" data-toggle="modal" type="submit">
                    <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                </a>
                <a title="Agregar cuenta bancaria"
                   href="{{URL::action('CuentaProveedorControlador@show',$p->id_proveedor)}}" type="submit"
                   class="btn btn-primary btn-sm"><i class="fab fa-cc-visa"></i></a>--}}
            </td>
        </tr>
        </tbody>
    </table>
</div>
{{--===============================================Modal New Proveedor======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-registro-proveedor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Nuevo Proveedor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                @include('proveedor.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar</button>
            </div>
        </div>
    </div>
</div>

{{--===============================================Modal Edit Proveedor======================================--}}
<div class="modal fade modal-slide-in-right"
     aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-proveedor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Actualizar Proveedor</h4>
                <button type="button" class="close"
                        @click="cancelModeEditProveedor"
                        data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                @include('proveedor.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="cancelModeEditProveedor" > Cerrar</button>
            </div>
        </div>
    </div>
</div>
{{--===============================================Modal Add Cuenta de Banco======================================--}}
<div class="modal fade modal-slide-in-right"
     aria-hidden="true" role="dialog" tabindex="-1" id="modal-add-cuenta-banco">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Cuentas</h4>

                <a v-show="!cuenta_proveedor.modeEdit" href
                   data-toggle="modal"
                   class="btn btn-outline-dark w-10em"
                   @click="cuenta_proveedor.modeCreate=!cuenta_proveedor.modeCreate"
                >
                    <span v-show="!cuenta_proveedor.modeCreate">Nueva</span>
                    <span v-show="cuenta_proveedor.modeCreate">Ver</span>
                </a>
                <button type="button" class="close"
                        @click="cancelModeEditCuentaProveedor"
                        data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <div v-if="!cuenta_proveedor.modeCreate">
                    @include('proveedor.cuentaproveedor.show')
                </div>
                <div v-else>
                    @include('proveedor.cuentaproveedor.create')
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar</button>
            </div>
        </div>
    </div>
</div>
{{--===============================================Modal Add Contacto======================================--}}
<div class="modal fade modal-slide-in-right"
     aria-hidden="true" role="dialog" tabindex="-1" id="modal-contacto">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Contactos de @{{ contacto.title }}</h4>

                <a v-show="!contacto.modeEdit" href
                   data-toggle="modal"
                   class="btn btn-outline-dark w-10em"
                   @click="contacto.modeCreate=!contacto.modeCreate"
                >
                    <span v-show="!contacto.modeCreate">Nuevo</span>
                    <span v-show="contacto.modeCreate">Ver</span>
                </a>
                <button type="button" class="close"
                        @click_="cancelModeEditCuentaProveedor"
                        data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <div v-if="!contacto.modeCreate">
                    @include('contacto.index')
                </div>
                <div v-else>
                    @include('contacto.create')
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar</button>
            </div>
        </div>
    </div>
</div>