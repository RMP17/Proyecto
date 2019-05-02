<a href data-target="#modal-new-almacen" data-toggle="modal"
   title="Nuevo Almacén">
    <button type="button" class="btn btn-outline-success btn-sm"><i
                class="fas fa-plus"></i></button>
</a>
<table class="table table-striped table-bordered table-sm">
    <thead>
    <tr>
        <th>Codigo</th>
        <th>Dirección</th>
        <th>Sucursal</th>
        <th>Acciones</th>
    </tr>
    </thead>

    <tbody>
    <tr v-for="_almacen in almacen.data">
        <td>@{{ _almacen.codigo }}</td>
        <td>@{{ _almacen.direccion }}</td>
        <td>@{{ _almacen.sucursal.nombre }}</td>
        <td>
            <a href="javascript:void(0)"
               title="Editar Almacén"
               @click="modeEditAlmacen(_almacen)"
               data-backdrop="static"
               data-keyboard="false"
               data-target="#modal-edit-almacen"
               data-toggle="modal"
               type="button" class="btn btn-warning btn-sm">
                <i class="mdi mdi-pencil"></i>
            </a>
           {{-- <a title="Editar" href="" data-target="#modal-edit-almacen-{{$a -> id_almacen}}" data-toggle="modal">
                <button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button>
            </a>
            <a titles="Eliminar" href="" data-target="#modal-delete-almacen-{{$a->id_almacen}}" data-toggle="modal">
                <button type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-delete-forever"></i></button>
            </a>--}}
        </td>
    </tr>
    </tbody>
</table>

{{--===============================================Modal New Empresa======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog"
     tabindex="-1" id="modal-new-almacen">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Nuevo Almacén</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                @include('sucursal.almacen.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal" @click=""> Cerrar</button>
            </div>
        </div>
    </div>
</div>

{{--===============================================Modal Edit Almacen======================================--}}
<div class="modal fade modal-slide-in-right"
     aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-almacen">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Editar Almacén</h4>
                <button type="button" class="close"
                        @click="cancelModeEditAlmacen"
                        data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                @include('sucursal.almacen.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                        data-dismiss="modal" @click="cancelModeEditAlmacen" > Cerrar</button>
            </div>
        </div>
    </div>
</div>
