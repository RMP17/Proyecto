<div class="form-group col mb-2">
    <div class="form-control  border border-info border-top-0 border-right-0 border-bottom-0">
        Total:
        <span class="float-right">@{{ venta.totalDetallesVenta }}</span>
    </div>
</div>
<div class="form-group  mb-2">
    <div class="col-auto">
        <input type="text" class="form-control"
               id="txtDescuento"
               @keypress="numberFloatDirective"
               @keyup="calcularTotale"
               v-model.number ="venta.attributes.descuento"
               placeholder="Descuento" name="descuento" autocomplete="off">
    </div>
</div>
<div class="form-group  mb-2">
    <div class="col-auto">
        <app-online-suggestions-objects v-if="!venta.hideSuggestions" :config="configCliente"
                                        :input-value="venta.cliente.tempAttributes.razon_social"
                                        @selected-suggestion-event="selectCliente">
        </app-online-suggestions-objects>
    </div>
</div>
<div class="form-group  mb-2">
    <div class="input-group col-auto">
        <input type="text" class="form-control" :class="venta.attributes.id_cliente ? 'border-success':''"
               id="txtNit"
               @keydown.enter="getClienteByNit"
               ref="txtNit"
               placeholder="Nit o Ci" name="nit" autocomplete="off">
        <div class="input-group-prepend">
            <a href="javascript:void(0)"
               title="Nuevo Cliente"
               data-backdrop="static"
               data-keyboad="false"
               data-target="#modal-new-client"
               data-toggle="modal"
               class="btn btn-outline-success"
            ><i class="fas fa-plus"></i>
            </a>
        </div>
    </div>
</div>

<div class="form-group  mb-2">
    <div class="col">
        <select class="custom-select"
                v-model="venta.attributes.tipo_pago"
                name="cbxMoneda">
            <option value="" disabled>Seleccione tipo de pago</option>
            <option value="ef">Efectivo</option>
            <option value="cr">Al crédito</option>
            <option value="ch">Cheque</option>
            <option value="tc">Tarjeta de crédito o débito</option>
        </select>
    </div>
</div>
<div class="form-group  mb-2">
    <div class="col-auto">
        <select class="custom-select"
                v-model="venta.attributes.id_moneda"
                name="cbxMoneda">
            <option :value="null" disabled>Seleccione tipo de moneda</option>
            <option v-for="_moneda in monedas" :value="_moneda.id_moneda">
                @{{ _moneda.nombre }} - @{{ _moneda.codigo }}
            </option>
        </select>
    </div>
</div>
<div class="form-group  mb-2">
    <div class="col-auto">
        <input type="text" class="form-control"
               id="txtCodigoTargetaOCheque"
               v-model="venta.attributes.codigo_tarjeta_cheque"
               placeholder="Código de la tarjeta o cheque" name="codigo_targeta">
    </div>
</div>
<div class="form-group  mb-2">
    <div class="col-auto">
        <a href="javascript:void(0)"
           data-backdrop="static"
           data-keyboad="false"
           data-target="#modal-realizar-venta"
           data-toggle="modal"
           @mouseup="focusButtonYes"
           class="btn btn-primary w-100 ">
            Realizar Venta
        </a>
    </div>
</div>
<!--======================================================Modal Confirmar Venta=====================================================-->
<div class="modal fade" id="modal-realizar-venta" tabindex="-1" role="dialog" aria-labelledby="modalGenerateinvoiceLabel" aria-hidden="true" v-cloak>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info" >
                <h5 class="modal-title text-white" id="modalTitleVenta">Confirmar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea realizar la venta?</p>
                <div class="input-group">
                    <div class="input-group-prepend col-md-3 p-0">
                        <span class="input-group-text w-100" id="basic-addon1">Total a pagar</span>
                    </div>
                    <div class="form-control text-right">@{{ venta.totalDetallesVenta }}</div>
                </div>
                <div class="input-group border border-info">
                    <div class="input-group-prepend col-md-3 p-0">
                        <span class="input-group-text w-100" id="txtImporte">Importe</span>
                    </div>
                    <input type="text"
                           class="form-control text-right"
                           v-model.number="venta.attributes.importe"
                           ref="txtImporte"
                           placeholder="00.00" aria-label="txtImporte" aria-describedby="txtImporte">
                </div>
                <div class="input-group">
                    <div class="input-group-prepend col-md-3 p-0">
                        <span class="input-group-text w-100" id="basic-addon1">Cambio</span>
                    </div>
                    <div class="form-control text-right">@{{ venta.attributes.importe-Number(venta.totalDetallesVenta)}}</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger w-25" data-dismiss="modal">NO</button>
                <button type="button" class="btn btn-outline-info w-25" data-dismiss="modal" @click="submitFormVenta">SI</button>
            </div>
        </div>
    </div>
</div>
{{--===============================================Modal New Client======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1"
     id="modal-new-client">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Nuevo Cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                @include('cliente.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>