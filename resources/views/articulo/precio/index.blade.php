<table class="table table-striped table-sm table-bordered">
    <thead>
    <tr>
        <th scope="col">Sucursal</th>
        <th scope="col">Precio 1</th>
        <th scope="col">Precio 2</th>
        <th scope="col">Precio 3</th>
        <th scope="col">Precio 4</th>
        <th scope="col">Precio 5</th>
        <th scope="col">Acciones</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="precio in articulosSucursales.precios">
        <td>@{{ precio.sucursal }}</td>
        <td>@{{ precio.precio_1 }}</td>
        <td>@{{ precio.precio_2 }}</td>
        <td>@{{ precio.precio_3 }}</td>
        <td>@{{ precio.precio_4 }}</td>
        <td>@{{ precio.precio_5 }}</td>
        <td>
            <a type="button" href="javascript:void(0);"
               title="Editar"
               @click="changeEditModePrecios(precio)"
               class="btn btn-warning btn-sm">
                <i class="mdi mdi-pencil"></i>
            </a>
        </td>
    </tr>
    </tbody>
</table>
