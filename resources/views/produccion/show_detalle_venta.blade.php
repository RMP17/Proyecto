<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <th>Artículo</th>
            <th>Ancho</th>
            <th>Largo</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
        </tr>
        </thead>
        <tbody v-if="produccion.oneProduccion">
        <tr v-for="_detalle in produccion.oneProduccion.detalles_produccion">
            <td>@{{ _detalle.articulo}}</td>
            <td>@{{ _detalle.ancho}}</td>
            <td>@{{ _detalle.largo}}</td>
            <td>@{{ _detalle.cantidad }}</td>
            <td>@{{ _detalle.precio_unitario }}</td>
        </tr>
        </tbody>
    </table>
</div>