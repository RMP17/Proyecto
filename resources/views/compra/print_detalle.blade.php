<div v-if="compra.one" class="section-to-print" ref="print_compra">
    <div id="print-section" class="hoja">
        <h5 class="text-center">COMPRAS</h5>
        <div>
            <p class="m-0"><strong>CÓDIGO : @{{ compra.one.id_compra }}</strong></p>
            <p class="m-0"><strong>PROVEEDOR : @{{ compra.one.proveedor }}</strong></p>
            <p class="m-0"><strong>OBSERVACIONES : @{{ compra.one.observaciones }}</strong></p>
            <div class="d-flex flex-row">
                <div class="col-6 p-0">
                      <p class="m-0"><strong>FECHA DE COMPRA : @{{ compra.one.fecha }}</strong></p>
                </div>
                <p class="m-0"><strong>FECHA DE LLEGADA : @{{ compra.one.fecha_llegada  }}</strong></p>
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
            <tbody v-if="compra.one">
            <tr v-for="_detalle in compra.one.detalle_compra">
                <td>
                    @{{ _detalle.articulo }}
                    {{--<span v-if="_detalle.ancho">@{{ parseInt(_detalle.ancho) }}X@{{ parseInt(_detalle.largo) }}</span>--}}
                </td>
                <td class="text-right ">@{{ _detalle.cantidad }}</td>
                <td class="text-right ">@{{ _detalle.precio_unitario }}</td>
                <td class="text-right ">@{{ _detalle.cantidad*_detalle.precio_unitario }}</td>
            </tr>
            </tbody>
        </table>
        <hr class="hr-point">
        <div class="d-flex align-items-end flex-column">
            <p class="m-0">
                <strong>TOTAL Bs. : <span style="display: inline-block;text-align: right;width: 5rem;">@{{ compra.one.costo_total }}</span></strong>

            </p>
            <p class="m-0">
                <strong>DESCUENTO Bs. : <span style="display: inline-block;text-align: right;width: 5rem;">@{{ compra.one.descuento }}</span></strong>
            </p>
            <p class="m-0">
                <strong>TOTAL A PAGAR Bs. : <span style="display: inline-block;text-align: right;width: 5rem;"
                    >@{{ (compra.one.costo_total - compra.one.descuento).toFixed(2) }}</span></strong>
            </p>
        </div>
    </div>
</div>