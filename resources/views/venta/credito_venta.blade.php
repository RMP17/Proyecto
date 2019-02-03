<form class="mb-3" @submit.prevent="registerVentaCredito">
    <div class="input-group">
        {{--<div class="input-group-prepend">
            <span class="input-group-text">Abonar</span>
        </div>--}}
        <input type="text"
               v-model="venta.credito.attributes.monto"
               @keypress="numberFloatDirective"
               aria-label="Monto" class="form-control" placeholder="Monto">
        <select class="custom-select"
                @change="assignMonedaCuenta($event)"
                v-model="venta.credito.attributes.tipo_pago"
                name="cbxTipoPago">
            <option :value="null" selected disabled>Seleccione tipo de pago</option>
            <option value="ef">Efectivo</option>
            <option value="ch">Cheque</option>
            <option value="tc">Tarjeta de crédito o débito</option>
        </select>
        <input type="text"
               v-model="venta.credito.attributes.observaciones"
               aria-label="observaciones" class="form-control" placeholder="Observaciones">
        <button type="submit" aria-label="Last name" class="btn  btn-primary">Realizar Pago</button>
    </div>
</form>
<div class="col-md-12">
    <h4 class="text-center">
        <span :class="{invisible: venta.credito.hideTotal }">@{{ venta.tempAttributes.costo_total - venta.credito.total }} </span>@{{ venta.tempAttributes.moneda }} Por pagar
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
        <tr v-for="_credito in venta.credito.data">
            <td>@{{ _credito.fecha}}</td>
            <td>@{{ _credito.monto }}</td>
            <td>
                <span v-if="_credito.tipo_pago ==='ef'">Efectivo</span>
                <span v-if="_credito.tipo_pago ==='ch'">Cheque</span>
                <span v-if="_credito.tipo_pago ==='tc'">Tarjeta de crédito o débito</span>
            </td>
            <td>@{{ _credito.observaciones }}</td>
        </tr>
        </tbody>
    </table>
</div>