<div class="form-group col mb-2">
    <div class="form-control  border border-info border-top-0 border-right-0 border-bottom-0">
        Total:
        <span class="float-right">{{ compra.totalDetallesCompra }}</span>
    </div>
</div>
<div class="form-group  mb-2">
    <!--<label for="txtFechaCompra"
           class="col-sm-2 control-label col-form-label">Nombre:</label>-->
    <div class="col-auto">
        <input type="text" class="form-control"
               id="txtDescuento"
               @keypress="numberFloatDirective"
               @keyup="calcularTotale"
               v-model.number ="compra.attributes.descuento"
               placeholder="Descuento" name="descuento">
    </div>
</div>
<div class="form-group  mb-2">
    <!--<label for="txtDescuento"
           class="col-sm-2 control-label col-form-label">Código:</label>-->
    <div class="col-auto">
        <input type="date" class="form-control"
               id="txtFechaCompra"
               v-model="compra.attributes.fecha"
               placeholder="Fecha de Compra" name="fecha">
    </div>
</div>
<div class="form-group  mb-2">
    <!--<label for="txtObservaciones"
           class="col-sm-2 control-label col-form-label">Código:</label>-->
    <div class="col">
        <select class="custom-select"
                @change="assignMonedaCuenta($event)"
                v-model="compra.attributes.tipo_pago"
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
    <!--<label for="txtObservaciones"
           class="col-sm-2 control-label col-form-label">Código:</label>-->
    <div class="col-auto">
        <select class="custom-select"
                @change="assignMonedaCuenta($event)"
                v-model="compra.attributes.id_moneda"
                name="cbxMoneda">
            <option :value="null" disabled>Seleccione tipo de moneda</option>
            <option v-for="_moneda in monedas" :value="_moneda.id_moneda">
                {{ _moneda.nombre }} - {{ _moneda.codigo }}
            </option>
        </select>
    </div>
</div>
<div class="form-group  mb-2">
    <!--<label for="txtObservaciones"
           class="col-sm-2 control-label col-form-label">Código:</label>-->
    <div class="col-auto">
        <select class="custom-select"
                v-model="compra.almacenSelected"
                name="cbxMoneda">
            <option :value="null" disabled>Seleccione Almacen</option>
            <option v-for="_almacen in almacenes" :value="_almacen.id_almacen">
                {{ _almacen.codigo }}
            </option>
        </select>
    </div>
</div>
<div class="form-group  mb-2">
    <!--<label for="txtObservaciones"
           class="col-sm-2 control-label col-form-label">Código:</label>-->
    <div class="col-auto">
        <div v-if="!compra.attributes.id_compra">
            <app-online-suggestions-objects v-if="!compra.hideSuggestions" :config="configProveedor"
                                            @selected-suggestion-event="assignAnIdentificationToProveedor">
            </app-online-suggestions-objects>
        </div>
        <div v-else>
            <app-online-suggestions-objects v-if="!compra.hideSuggestions" :config="configProveedor"
                                            :input-value="compra.tempAttributes.proveedor.razon_social"
                                            @selected-suggestion-event="assignAnIdentificationToContacto">
            </app-online-suggestions-objects>
        </div>
    </div>
</div>
<div class="form-group  mb-2">
    <!--<label for="txtCodigoTargetaOCheque"
           class="col-sm-2 control-label col-form-label">Código:</label>-->
    <div class="col-auto">
        <input type="text" class="form-control"
               id="txtNroFactura"
               v-model="compra.attributes.nro_factura"
               placeholder="Número de la factura" name="nro_factura">
    </div>
</div>
<div class="form-group  mb-2">
    <!--<label for="txtCodigoTargetaOCheque"
           class="col-sm-2 control-label col-form-label">Código:</label>-->
    <div class="col-auto">
        <input type="text" class="form-control"
               id="txtCodigoTargetaOCheque"
               v-model="compra.attributes.codigo_tarjeta_cheque"
               placeholder="Código de la tarjeta o cheque" name="codigo_targeta">
    </div>
</div>
<div class="form-group  mb-2">
    <!--<label for="txtObservaciones"
           class="col-sm-2 control-label col-form-label">Código:</label>-->
    <div class="col-auto">
        <textarea
                class="form-control"
                placeholder="Observaciones"
                v-model="compra.attributes.observaciones"
                name="observaciones" id="txtObservaciones" rows="1"></textarea>
    </div>
</div>
<div class="form-group  mb-2">
    <!--<label for="txtObservaciones"
           class="col-sm-2 control-label col-form-label">Código:</label>-->
    <div class="col-auto">
        <a href="javascript:void(0)"
           data-backdrop="static"
           data-keyboad="false"
           data-target="#modal-realizar-compra"
           data-toggle="modal"
           @mouseup="focusButtonYes"
           class="btn btn-primary w-100 ">
            Realizar Compra
        </a>
    </div>
</div>


<!--======================================================Modal Confirmar Compra=====================================================-->
<div class="modal fade" id="modal-realizar-compra" tabindex="-1" role="dialog" aria-labelledby="modalGenerateinvoiceLabel" aria-hidden="true" v-cloak>
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info" >
                <h5 class="modal-title text-white" id="modalTitleVenta">Confirmar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Está seguro que desea realizar la compra?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger w-25" data-dismiss="modal">NO</button>
                <button ref="btnSi" type="button" class="btn btn-outline-info w-25" data-dismiss="modal" @click="submitFormCompra">SI</button>
            </div>
        </div>
    </div>
</div>