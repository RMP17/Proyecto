<a href data-target="#modal-registro-empresa" data-toggle="modal"
   title="Nueva Empresa">
    <button type="button" class="btn btn-outline-success btn-sm"><i
                class="fas fa-plus"></i></button>
</a>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <th scope="col">Razón social</th>
            <th scope="col">NIT</th>
            <th scope="col">Propietario</th>
            <th scope="col">Actividad</th>
            <th scope="col">Acciones</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="_empresa in empresa.data">
            <td>@{{ _empresa.razon_social }}</td>
            <td>@{{ _empresa.nit }}</td>
            <td>@{{ _empresa.propietario }}</td>
            <td>@{{ _empresa.actividad }}</td>
            <td>
                <a href="javascript:void(0)"
                   title="Editar Empresa"
                   @click="modeEditEmpresa(_empresa)"
                   data-backdrop="static"
                   data-keyboard="false"
                   data-target="#modal-edit-empresa"
                   data-toggle="modal"
                   type="button" class="btn btn-warning btn-sm">
                    <i class="mdi mdi-pencil"></i>
                </a>
                <a href="javascript:void(0)"
                   title="Ver Sucursales"
                   @click="seeSucursalesOfEmpresa(_empresa)"
                   data-backdrop="static"
                   data-keyboard="false"
                   data-target="#modal-sucursales"
                   data-toggle="modal"
                   type="button" class="btn btn-info btn-sm">
                    <i class="fas fa-building"></i>
                </a>
                {{--<a title="Sucursales"
                   href="{{URL::action('SucursalControlador@show',$e->id_empresa)}}"
                   type="submit" class="btn btn-sm"><img style="width: 19px"
                                                         src="{{asset('nihil/imagenes/store2.png')}}"></a>
                <a title="Cuenta Bancaria"
                   href="{{URL::action('CuentaControlador@show',$e->id_empresa)}}"
                   type="submit" class="btn btn-primary btn-sm"><i
                            class="fab fa-cc-visa"></i></a>--}}
            </td>
        </tr>
        </tbody>
    </table>
</div>
{{--===============================================Modal New Empresa======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-registro-empresa">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Nueva Empresa</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                @include('empresa.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click=""> Cerrar</button>
            </div>
        </div>
    </div>
</div>
{{--===============================================Modal Edit Empresa======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true"
     role="dialog" tabindex="-1" id="modal-edit-empresa">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Edit Empresa</h4>
                <button type="button" class="close"
                        @click="cancelModeEditEmpresa"
                        data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                @include('empresa.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="cancelModeEditEmpresa"> Cerrar</button>
            </div>
        </div>
    </div>
</div>

{{--===============================================Modal Sucursales ======================================--}}
<div class="modal fade modal-slide-in-right"
     aria-hidden="true" role="dialog" tabindex="-1" id="modal-sucursales">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Sucursales de @{{ empresa.oneEmpresa ? empresa.oneEmpresa.razon_social:'' }}</h4>

                <a v-show="!empresa_sucursal.modeEdit" href
                   data-toggle="modal"
                   class="btn btn-outline-dark w-10em"
                   @click="empresa_sucursal.modeCreate=!empresa_sucursal.modeCreate"
                >
                    <span v-show="!empresa_sucursal.modeCreate">Nueva</span>
                    <span v-show="empresa_sucursal.modeCreate">Ver</span>
                </a>
                <button type="button" class="close"
                        @click="cancelModeEditEmpresaSucursal"
                        data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                <div v-show="!empresa_sucursal.modeCreate">
                    @include('sucursal.show')
                </div>
                <div v-show="empresa_sucursal.modeCreate">
                    @include('sucursal.create')
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click="cancelModeEditEmpresaSucursal"> Cerrar</button>
            </div>
        </div>
    </div>
</div>