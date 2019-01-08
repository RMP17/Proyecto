<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Fecha Apertura</th>
            <th>Ciudad</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
        </thead>

        <tbody>
            <tr v-for="_sucursal in empresa_sucursal.sucursales">
                <td>@{{ _sucursal.nombre }}</td>
                <td>@{{ _sucursal.direccion }}</td>
                <td>@{{ _sucursal.telefono}}</td>
                <td>@{{ _sucursal.fecha_apertura}}</td>
                <td>@{{ _sucursal.ciudad ? _sucursal.ciudad.pais_ciudad: '' }}</td>
                <td></td>
                <td>
                    <a href="javascript:void(0)"
                       title="Editar Sucursal"
                       @click="changeModeEditEmpresaSucursal(_sucursal)"
                       type="button" class="btn btn-warning btn-sm">
                        <i class="mdi mdi-pencil"></i>
                    </a>
                    {{--<a title="Editar" href="{{URL::action('SucursalControlador@edit',$s->id_sucursal)}}" type="submit"
                       class="btn btn-warning btn-sm"> <i class="mdi mdi-pencil"></i></a>
                    <a title="Dar de baja" href="" data-target="#modal-delete-{{$s->id_sucursal}}" data-toggle="modal"
                       type="submit" class="btn btn-danger btn-sm"><i class="mdi mdi-thumb-down"></i></a>
                    <a title="Registrar almacen" href="{{URL::action('AlmacenControlador@show', $s -> id_sucursal)}}">
                        <button type="button" class="btn btn-dark btn-sm"><i class="mdi mdi-plus-circle"></i></button>
                    </a>--}}
                </td>
            </tr>
        </tbody>
    </table>
</div>