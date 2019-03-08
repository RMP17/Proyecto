<div v-if="venta.oneVenta" id="myPrintArea" class="section-to-print" ref="print_venta">
    <div id="print-section" class="hoja">
        <h5 class="text-center">COMPROBANTE</h5>
        <div>
            <p class="m-0"><strong>SUCURSAL : @{{ venta.oneVenta.sucursal.nombre }}</strong></p>
            <p class="m-0"><strong>CAJA : @{{ venta.oneVenta.caja }}</strong></p>
            <p class="m-0"><strong>FECHA : @{{ venta.oneVenta.fecha }}</strong></p>
            <p class="m-0"><strong>NIT : @{{ venta.oneVenta.cliente.nit }}</strong></p>
            <p class="m-0"><strong>CLIENTE : @{{ venta.oneVenta.cliente.razon_social }}</strong></p>
            <p class="m-0"><strong>TIPO DE VENTA : @{{ venta.oneVenta.tipo_pago }}</strong></p>
            {{--<p class="m-0"><strong>SUCRE - BOLIVIA</strong></p>
            <p class="m-0"><strong>FACTURA ORIGINAL</strong></p>--}}
        </div>
        <hr class="hr-point">
         <div>
             <table class="table table-striped table-sm m-0">
                 <thead>
                 <tr>
                     <th >ARTÍCULO</th>
                     <th width="1%" >CANTIDAD</th>
                     <th width="1%">P.UNITARIO</th>
                     <th width="10%">SUB TOTAL</th>
                 </tr>
                 </thead>
                 <tbody>
                    <tr v-for="_detalle in venta.oneVenta.detalles_venta">
                        <td>
                            <span >@{{ _detalle.articulo}}</span>
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
                     <strong>TOTAL A PAGAR Bs. : <span style="display: inline-block;text-align: right;width: 5rem;">@{{ venta.oneVenta.costo_total }}</span></strong>

                 </p>
                 <p class="m-0">
                     <strong>DESCUENTO Bs. : <span style="display: inline-block;text-align: right;width: 5rem;">@{{ venta.oneVenta.descuento }}</span></strong>
                 </p>
                 <p class="m-0">
                     <strong>IMPORTE Bs. : <span style="display: inline-block;text-align: right;width: 5rem;">@{{ venta.oneVenta.importe }}</span></strong>
                 </p>
                 <p class="m-0">
                     <strong>CAMBIO Bs. : <span style="display: inline-block;text-align: right;width: 5rem;"
                         >@{{ Number(venta.oneVenta.importe) - Number(venta.oneVenta.costo_total) + Number(venta.oneVenta.descuento)}}</span></strong>
                 </p>
             </div>
             {{--<p class="m-0"><strong>SON:</strong>{{ (invoice.total - invoice.descuento) | numbersToLettersPipe }}
                 CON {{ (invoice.efectivo - invoice.descuento)| centavos }}/100 BOLIVIANOS</p>--}}

         </div>
        <hr class="hr-point">
        <div>
            {{--<p class="m-0"><strong>CÓDIGO DE CONTROL: {{ invoice.factura?.codigo_control }} </strong></p>
            <p class="m-0"><strong>FECHA LÍMITE DE EMISIÓN: {{configuracion.fecha_limite_emision | date: 'dd/MM/yyyy'}}</strong></p>
            <div class="p-2 d-flex justify-content-center">
                <qrcode [qrdata]="dataForQr" [size]="128" [level]="'M'"></qrcode>
            </div>--}}
            <div class="d-flex justify-content-between">
                <p class="m-0"><strong>Teléfono: @{{ venta.oneVenta.sucursal.telefono }}</strong></p>
                <p class="m-0"><strong>Dirección: @{{ venta.oneVenta.sucursal.direccion }}</strong></p>
                <p class="m-0"><strong>Gracias por su preferencia</strong></p>
            </div>
        </div>
    </div>
    <!--<span *ngIf="!invoice.factura">No existe datos para llenar la factura</span>-->
</div>