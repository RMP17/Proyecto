<div v-if="movimiento_almacen.oneMovimientoAlmacen" id="myPrintArea" class="section-to-print">
    <div id="print-section" class="hoja">
        <h5 class="text-center">COMPROBANTE</h5>
        <div>
            <p class="m-0"><strong>EMPLEADO : @{{ movimiento_almacen.oneMovimientoAlmacen.empleado }}</strong></p>
            <p class="m-0"><strong>FECHA : @{{ movimiento_almacen.oneMovimientoAlmacen.fecha }}</strong></p>
            <p class="m-0"><strong>ALMACÉN DE ORIGEN: @{{ movimiento_almacen.oneMovimientoAlmacen.almacen_origen }}</strong></p>
            <p class="m-0"><strong>ALMACÉN DE DESTINO: @{{ movimiento_almacen.oneMovimientoAlmacen.almacen_destino }}</strong></p>
        </div>
        <hr class="hr-point">
         <div>
             <table class="table table-striped table-sm m-0">
                 <thead>
                 <tr>
                     <th >ARTÍCULO</th>
                     <th width="1%" >CANTIDAD</th>
                 </tr>
                 </thead>
                 <tbody>
                    <tr v-for="_detalle in movimiento_almacen.oneMovimientoAlmacen.movimientos_almacen_detalle">
                        <td>@{{ _detalle.articulo }}</td>
                        <td class="text-right ">@{{ _detalle.cantidad }}</td>
                    </tr>
                 </tbody>
             </table>
             <hr class="hr-point">
         </div>
    </div>
</div>