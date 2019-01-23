<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <th>Artículo</th>
            <th>Cantidad</th>
            <th>Precio Unitario</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="_detalle in compra.detallesCompra">
            <td>@{{ _detalle.articulo}}</td>
            <td>@{{ _detalle.cantidad }}</td>
            <td>@{{ _detalle.precio_unitario }}</td>
        </tr>
        </tbody>
    </table>
</div>