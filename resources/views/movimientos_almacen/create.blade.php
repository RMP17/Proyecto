<div class="form-group col mb-2">
    <select class="custom-select"
            v-model="movimiento_almacen.attributes.id_almacen_origen"
            @change="selectStockAlmacen($event.target.value)"
            name="selectIdAlmacenOrigen">
        <option :value="null" disabled>Seleccione el almacén origen</option>
        <option v-for="_almacen in almacenes" :value="_almacen.id_almacen">@{{_almacen.codigo}}</option>
    </select>
</div>
<div class="form-group col mb-2">
    <select class="custom-select"
            v-model="movimiento_almacen.attributes.id_almacen_destino"
            name="selectIdAlmacenDestino">
        <option :value="null" disabled>Seleccione el almacén destino</option>
        <option v-for="_almacen in almacenes" :value="_almacen.id_almacen">@{{_almacen.codigo}}</option>
    </select>
</div>
<div class="form-group col mb-2">
    <textarea class="form-control"
              placeholder="Observaciones"
              rows="2"
              v-model="movimiento_almacen.attributes.observaciones"
              name="selectIdAlmacenDestino">
    </textarea>
</div>
<div class="form-group col mb-2">
    <button type="button" class="btn btn-info w-100" @click="submitFormMovimiento">Realizar envío</button>
</div>
