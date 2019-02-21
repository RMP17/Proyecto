<div v-if="produccion.oneProduccion" class="section-to-print" ref="print_produccion">
    <div id="print-section" class="hoja">
        <h5 class="text-center">PRODUCCIÓN</h5>
        <div>
            <p class="m-0"><strong>CÓDIGO : @{{ produccion.oneProduccion.id_produccion }}</strong></p>
            <p class="m-0"><strong>CLIENTE : @{{ produccion.oneProduccion.cliente.razon_social }}</strong></p>
            <div class="d-flex flex-row">
                <div class="col-6 p-0">
                    <p class="m-0"><strong>DIRECCIÓN : @{{ produccion.oneProduccion.cliente.direccion }}</strong></p>
                </div>
                <p class="m-0"><strong>TEL/CEL : @{{ produccion.oneProduccion.cliente.celular ? produccion.oneProduccion.cliente.celular:produccion.oneProduccion.cliente.telefono }}</strong></p>
            </div>
            <p class="m-0"><strong>OBSERVACIONES : @{{ produccion.oneProduccion.observaciones }}</strong></p>
            <div class="d-flex flex-row">
                <div class="col-6 p-0">
                      <p class="m-0"><strong>FECHA DE PEDIDO : @{{ produccion.oneProduccion.fecha_inicio }}</strong></p>
                </div>
                <p class="m-0"><strong>FECHA DE ENTREGA : @{{ produccion.oneProduccion.fecha_entrega }}</strong></p>
            </div>
        </div>
        <hr class="hr-point">
        <table class="table table-striped table-sm m-0">
            <thead>
            <tr>
                <th>ARTÍCULO</th>
                <th>CANTIDAD</th>
                <th>P.UNITARIO</th>
                <th>SUB TOTAL</th>
            </tr>
            </thead>
            <tbody v-if="produccion.oneProduccion">
            <tr v-for="_detalle in produccion.oneProduccion.detalles_produccion">
                <td>
                    @{{ _detalle.articulo }}
                    <span v-if="_detalle.ancho">@{{ parseInt(_detalle.ancho) }}X@{{ parseInt(_detalle.largo) }}</span>
                </td>
                <td class="text-right ">@{{ _detalle.cantidad }}</td>
                <td class="text-right ">@{{ _detalle.precio_unitario }}</td>
                <td class="text-right ">@{{ _detalle.cantidad*_detalle.precio_unitario }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="text-right">A/C : @{{ produccion.oneProduccion.total_monto_credito }}</td>
                <td class="text-right">SALDO : @{{ produccion.oneProduccion.costo_total - produccion.oneProduccion.total_monto_credito }}</td>
                <td class="text-right">TOTAL Bs. : @{{ produccion.oneProduccion.costo_total }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>