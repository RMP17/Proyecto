{{--<div class="d-flex justify-content-center mb-2" v-if="!movimiento_almacen.hideSuggestionsArticulo">
    <div class="col pr-0">
        <input class="form-control"
               ref="input_nit_empleado"
               @keydown.enter="getArticuloByCodigo($event)"
               placeholder="Código del Artículo" type="text">
    </div>
    <div class="col pr-0 pl-0">
        <app-online-suggestions-objects :config="configEmpleado"
                                        :input-value="movimiento_almacen.articulo.tempNombre"
                                        @selected-suggestion-event="selectArticuloMovimientoAlmacen">
        </app-online-suggestions-objects>
    </div>
    <div class="col pl-0">
        <app-online-suggestions-objects :config="configArticulo"
                                        :input-value="movimiento_almacen.articulo.tempNombre"
                                        @selected-suggestion-event="selectArticuloMovimientoAlmacen">
        </app-online-suggestions-objects>
    </div>
</div>--}}
<div class="d-flex justify-content-center mb-2">
    <div class="col pr-0">
        <input class="form-control"
               title="Ejemplo: Puerto, Ventana"
               v-model="medicion.detalle.attributes.descripcion"
               placeholder="Descripción" type="text">
    </div>
    <div class="col pr-0 pl-0">
        <input class="form-control"
               v-model.number="medicion.detalle.attributes.ancho"
               @keypress="numberFloatDirective"
               placeholder="Ancho" type="text">
    </div>
    <div class="col pl-0">
        <input class="form-control"
               @keypress="numberFloatDirective"
               v-model.number="medicion.detalle.attributes.alto"
               placeholder="Alto" type="text">
    </div>
</div>
<div class="d-flex justify-content-center mb-2">
    <div class="col pr-0">
        <input class="form-control"
               @keypress="numberPositiveDirective"
               v-model.number="medicion.detalle.attributes.cantidad"
               placeholder="Cantidad" type="text">
    </div>
    <div class="col pr-0 pl-0">
        <input class="form-control"
               v-model="medicion.detalle.attributes.ubicacion"
               placeholder="Ubicación" type="text">
    </div>
    <div class="col pl-0">
        <button type="button" class="btn btn-info w-100" @click="addToList">Agregar a la lista</button>
    </div>
</div>
<div class="col">
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Descripción</th>
                <th>Ancho</th>
                <th>Alto</th>
                <th>Cantidad</th>
                <th>Ubicacion</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(_detalle,index) in medicion.attributes.detalles">
                <td>
                    <a href="javascript:void(0)"
                       @click="removeOfList(index)"
                       class="text-danger" title="Quitar"
                    ><i class="fas fa-minus fa-lg"></i>
                    </a>
                    @{{ _detalle.descripcion}}
                </td>
                <td>@{{ _detalle.ancho}}</td>
                <td>@{{ _detalle.alto}}</td>
                <td>@{{ _detalle.cantidad}}</td>
                <td>@{{ _detalle.ubicacion}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


