<form class="mb-3" @submit.prevent="registerProduccionEntrega">
    <div class="input-group" v-if="!produccion.entrega.hideSuggestionsAll">
        <div class="col p-0">
            <app-online-suggestions-objects :config="configEmpleado"
                                            @selected-suggestion-event="selectEmpleadoForProduccionEntrega">
            </app-online-suggestions-objects>
        </div>
        <div class="col p-0">
            <app-online-suggestions-objects v-if="!this.produccion.entrega.hideSuggestions"
                                            :config="configArticulo"
                                            @selected-suggestion-event="selectArticuloForProduccionEntrega">
            </app-online-suggestions-objects>
        </div>
        <div class="col-2 p-0">
            <input type="text"
                   v-model.number="produccion.entrega.attributes.cantidad"
                   @keypress="numberPositiveDirective"
                   aria-label="Monto" class="form-control" placeholder="cantidad">
        </div>
        <div>
            <button type="submit" aria-label="Last name" class="btn  btn-primary">Entregar</button>
        </div>
    </div>
</form>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <th>Fecha y hora</th>
            <th>Empleado</th>
            <th>Álmacen</th>
            <th>Artículo</th>
            <th>Cantidad</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="_entrega in produccion.entrega.data">
            <td>@{{ _entrega.fecha }}</td>
            <td>@{{ _entrega.empleado.nombre }}</td>
            <td>@{{ _entrega.almacen.codigo }}</td>
            <td>@{{ _entrega.articulo.nombre }}</td>
            <td>@{{ _entrega.cantidad }}</td>
        </tr>
        </tbody>
    </table>
</div>