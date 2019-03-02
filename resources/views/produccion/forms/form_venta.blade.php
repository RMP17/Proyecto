<div class="form-group col mb-2">
    <div class="form-control  border border-info border-top-0 border-right-0 border-bottom-0">
        Total:
        <span class="float-right">@{{ produccion.totalDetalles }}</span>
    </div>
</div>
{{--<div class="form-group  mb-2">
    <div class="col-auto">
        <input type="text" class="form-control"
               id="txtDescuento"
               @keypress="numberFloatDirective"
               @keyup="calcularTotale"
               v-model.number ="venta.attributes.descuento"
               placeholder="Descuento" name="descuento" autocomplete="off">
    </div>
</div>--}}
<div class="form-group  mb-2">
    <div class="input-group col-auto">
        <input type="text" class="form-control" :class="produccion.attributes.id_cliente ? 'border-success':''"
               id="txtNit"
               @keydown.enter="getClienteByNit"
               ref="txtNit"
               placeholder="Nit o Ci" name="nit" autocomplete="off">
        <div class="input-group-prepend">
            <a href="javascript:void(0)"
               title="Nuevo Cliente"
               data-backdrop="static"
               data-keyboad="false"
               data-target="#modal-new-client-produccion"
               data-toggle="modal"
               class="btn btn-outline-success"
            ><i class="fas fa-plus"></i>
            </a>
        </div>
    </div>
</div>
<div class="form-group  mb-2">
    <div class="col-auto">
        <app-online-suggestions-objects v-if="!produccion.hideSuggestionsClient" :config="configCliente"
                                        :input-value="produccion.cliente.one.razon_social"
                                        @selected-suggestion-event="selectCliente">
        </app-online-suggestions-objects>
    </div>
</div>

<div class="form-group  mb-2">
    <div class="col">
        <select class="custom-select"
                v-model="produccion.attributes.tipo_pago"
                name="slctTipoPago">
            <option :value="null" disabled>Seleccione tipo de pago</option>
            <option value="ef">Efectivo</option>
            <option value="cr">Al crédito</option>
            <option value="co">Solo Cotización</option>
            <option value="ch">Cheque</option>
            <option value="tc">Tarjeta de crédito o débito</option>
        </select>
    </div>
</div>
<div class="form-group  mb-2">
    <div class="col-auto">
        <textarea class="form-control"
                  v-model="produccion.attributes.observaciones"
                  placeholder="Observaciones" type="text">

        </textarea>
    </div>
</div>
<div class="form-group  mb-2">
    <div class="col-auto">
        <a href="javascript:void(0)"
           data-backdrop="static"
           data-keyboad="false"
           data-target="#modal-producir"
           data-toggle="modal"
           @mouseup="focusButtonYes"
           class="btn btn-primary w-100 ">
            Producir
        </a>
    </div>
</div>
<!--======================================================Modal Confirmar Venta=====================================================-->
<div class="modal fade" id="modal-producir" tabindex="-1" role="dialog" aria-labelledby="modalPorucir" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info" >
                <h5 class="modal-title text-white" id="modalTitleVenta">Confirmar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea registrar la producción?</p>
                <div class="input-group">
                    <div class="input-group-prepend col-md-4 p-0">
                        <span class="input-group-text w-100" id="basic-addon1">Fecha de pedido</span>
                    </div>
                    <input type="date" v-model="produccion.attributes.fecha_inicio" class="form-control">
                </div>
                <div class="input-group">
                    <div class="input-group-prepend col-md-4 p-0">
                        <span class="input-group-text w-100" id="basic-addon1">Fecha de entrega</span>
                    </div>
                    <input type="date" v-model="produccion.attributes.fecha_entrega" class="form-control">
                </div>
                <div v-if="['ef', 'ch', 'tc', 'cr'].indexOf(produccion.attributes.tipo_pago) !==-1 ">
                    <div class="input-group">
                        <div class="input-group-prepend col-md-4 p-0">
                            <span class="input-group-text w-100" id="basic-addon1">Total a pagar</span>
                        </div>
                        <div class="form-control text-right">@{{ produccion.totalDetalles }}</div>
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend col-md-4 p-0">
                            <span class="input-group-text w-100" id="txtImporte">Importe</span>
                        </div>
                        <input type="text"
                               class="form-control text-right"
                               v-model.number="produccion.attributes.importe"
                               placeholder="00.00" aria-label="txtImporte" aria-describedby="txtImporte">
                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend col-md-4 p-0">
                            <span class="input-group-text w-100" id="basic-addon1">Cambio</span>
                        </div>
                        <div class="form-control text-right">@{{ produccion.attributes.importe-Number(produccion.totalDetalles)}}</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger w-25" data-dismiss="modal">NO</button>
                <button ref="btnSi" type="button" class="btn btn-outline-info w-25" data-dismiss="modal" @click="submitFormProduccion">SI</button>
            </div>
        </div>
    </div>
</div>
{{--===============================================Modal New Client======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1"
     id="modal-new-client-produccion">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Nuevo Cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                @include('produccion.cliente.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>