<form class="mb-3" @submit.prevent="registerCompraCredito">
    <div class="input-group">
        {{--<div class="input-group-prepend">
            <span class="input-group-text">Abonar</span>
        </div>--}}
        <input type="text"
               v-model="compra.credito.monto"
               @keypress="numberFloatDirective"
               aria-label="Monto" class="form-control" placeholder="Monto">
        <select class="custom-select"
                @change="assignMonedaCuenta($event)"
                v-model="compra.credito.tipo_pago"
                name="cbxTipoPago">
            <option value="" disabled>Seleccione tipo de pago</option>
            <option value="ef">Efectivo</option>
            <option value="ch">Cheque</option>
            <option value="tc">Tarjeta de crédito o débito</option>
        </select>
        <input type="text"
               v-model="compra.credito.observaciones"
               aria-label="observaciones" class="form-control" placeholder="Observaciones">
        <button type="submit" aria-label="Last name" class="btn  btn-primary">Realizar Pago</button>
    </div>
</form>
<div class="col-md-12">
    <h4 class="text-center">
        @{{ compra.tempAttributes.costo_total - compra.compra_credito_total +' '+compra.tempAttributes.moneda}} Por pagar
    </h4>
</div>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <th>Fecha y hora</th>
            <th>Monto</th>
            <th>Tipo de pago</th>
            <th>Observaciones</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="_credito in compra.compra_credito_data">
            <td>@{{ _credito.fecha}}</td>
            <td>@{{ _credito.monto }}</td>
            <td>@{{ _credito.tipo_pago }}</td>
            <td>@{{ _credito.observaciones }}</td>
        </tr>
        </tbody>
    </table>
</div>