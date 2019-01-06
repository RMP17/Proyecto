<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <th>Entidad</th>
            <th>Nro. Cuenta</th>
            <th>Moneda</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
            <tr v-for="cuenta in cuenta_proveedor.cuentas">
                <td>@{{ cuenta.entidad }}</td>
                <td>@{{ cuenta.nro_cuenta }}</td>
                <td>@{{ cuenta.moneda}}</td>
                <td>
                    <a href="javascript:void(0)"
                       title="Editar Proveedor"
                       @click="modeEditProveedor(_proveedor)"
                       data-target="#modal-edit-proveedor"
                       data-toggle="modal"
                       type="button" class="btn btn-warning btn-sm">
                        <i class="mdi mdi-pencil"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>