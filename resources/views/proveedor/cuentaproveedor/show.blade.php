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
            <tr v-for="(_cuenta, index) in cuenta_proveedor.cuentas">
                <td>@{{ _cuenta.entidad }}</td>
                <td>@{{ _cuenta.nro_cuenta }}</td>
                <td>@{{ _cuenta.moneda}}</td>
                <td>
                    <a href="javascript:void(0)"
                       title="Editar Cuenta"
                       @click="changeModeEditCuentaProveedor(_cuenta)"
                       type="button" class="btn btn-warning btn-sm">
                        <i class="mdi mdi-pencil"></i>
                    </a>
                    <a title="Eliminar Cuenta" href="javascript:void(0)"
                       type="button" @click="deleteCuentaProveedor(_cuenta.id_cuenta, index)"
                       class="btn btn-danger btn-sm">
                        <i class="mdi mdi-delete-forever"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
</div>