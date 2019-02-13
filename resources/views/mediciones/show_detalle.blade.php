<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <th>Descripción</th>
            <th>Ancho</th>
            <th>Alto</th>
            <th>Cantidad</th>
            <th>Ubicación</th>
        </tr>
        </thead>
        <tbody v-if="medicion.oneMedicion">
        <tr v-for="_detalle in medicion.oneMedicion.medicion_detalle">
            <td>@{{ _detalle.descripcion}}</td>
            <td>@{{ _detalle.ancho }}</td>
            <td>@{{ _detalle.alto }}</td>
            <td>@{{ _detalle.cantidad }}</td>
            <td>@{{ _detalle.ubicacion }}</td>
        </tr>
        </tbody>
    </table>
</div>