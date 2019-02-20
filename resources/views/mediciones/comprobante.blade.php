<div v-if="medicion.oneMedicion" id="myPrintArea" class="section-to-print" ref="print_medicion">
    <div id="print-section" class="hoja">
        <h5 class="text-center">MEDICIONES</h5>
        <div>
            <p class="m-0"><strong>EMPLEADO : @{{ medicion.oneMedicion.empleado }}</strong></p>
            <p class="m-0"><strong>CLIENTE : @{{ medicion.oneMedicion.cliente }}</strong></p>
            <p class="m-0"><strong>FECHA DE VISITA : @{{ medicion.oneMedicion.fecha_visita }}</strong></p>
            <p class="m-0"><strong>DIRECCIÓN : @{{ medicion.oneMedicion.direccion }}</strong></p>
            <p class="m-0"><strong>OBSERVACIONES : @{{ medicion.oneMedicion.observaciones }}</strong></p>
        </div>
        <hr class="hr-point">
        <table class="table table-striped table-sm m-0">
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
        <hr class="hr-point">
    </div>
</div>