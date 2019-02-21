<form class="mb-3" @submit.prevent="registerPayCreditoOfProduccion">
    <div class="input-group">
        <input type="text"
               v-model="produccion.credito.attributes.monto"
               @keypress="numberFloatDirective"
               aria-label="Monto" class="form-control" placeholder="Monto">
        <input type="text"
               v-model="produccion.credito.attributes.observaciones"
               aria-label="observaciones" class="form-control" placeholder="Observaciones">
        <button type="submit" aria-label="Last name" class="btn  btn-primary">Realizar Pago</button>
    </div>
</form>
<div class="col-md-12">
    <h4 class="text-center">
        <span v-if="produccion.oneProduccion" :class="{invisible: produccion.credito.hideTotal }">@{{ produccion.oneProduccion.costo_total - produccion.credito.total }} </span> Bs. Por pagar
    </h4>
</div>
<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <th>Fecha y hora</th>
            <th>Monto</th>
            <th>Observaciones</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="_credito in produccion.credito.data">
            <td>@{{ _credito.fecha }}</td>
            <td>@{{ _credito.monto }}</td>
            <td>@{{ _credito.observaciones }}</td>
        </tr>
        </tbody>
    </table>
</div>