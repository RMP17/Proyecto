<table class="table table-striped table-bordered table-sm">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Acciones</th>
    </tr>
    </thead>
    <tbody>
        <tr v-for="(_ciudad, index) in pais.ciudad.data">
            <th scope="row">@{{ index + 1 }}</th>
            <td>@{{ _ciudad.nombre }}</td>
            <td>
                <a href="javascript:void(0)"
                   @click="modeEditCiudad(_ciudad)"
                   type="button" class="btn btn-warning btn-sm">
                    <i class="mdi mdi-pencil"></i>
                </a>
            </td>
        </tr>
    </tbody>
</table>