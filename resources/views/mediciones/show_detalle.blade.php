<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <th>Artículo</th>
            <th>Cantidad</th>
        </tr>
        </thead>
        <tbody v-if="movimiento_almacen.oneMovimientoAlmacen">
        <tr v-for="_detalle in movimiento_almacen.oneMovimientoAlmacen.movimientos_almacen_detalle">
            <td>@{{ _detalle.articulo}}</td>
            <td>@{{ _detalle.cantidad }}</td>
        </tr>
        </tbody>
    </table>
</div>