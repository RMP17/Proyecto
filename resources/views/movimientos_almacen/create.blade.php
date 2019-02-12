<div class="form-group col mb-2">
    <select class="custom-select"
            v-model="movimiento_almacen.attributes.id_almacen_origen"
            @change="selectStockAlmacen(movimiento_almacen.attributes.id_almacen_origen);selectNameAlmacen($event, 'origen')"
            name="selectIdAlmacenOrigen">
        <option :value="null" disabled>Seleccione el almacén origen</option>
        <option v-for="_almacen in almacenes" :value="_almacen.id_almacen">@{{_almacen.codigo}}</option>
    </select>
</div>
<div class="form-group col mb-2">
    <select class="custom-select"
            v-model="movimiento_almacen.attributes.id_almacen_destino"
            @change="selectNameAlmacen($event, 'destino')"
            name="selectIdAlmacenDestino">
        <option :value="null" disabled>Seleccione el almacén destino</option>
        <option v-for="_almacen in almacenes" :value="_almacen.id_almacen">@{{_almacen.codigo}}</option>
    </select>
</div>
<div class="form-group col mb-2">
    <button type="button" class="btn btn-info w-100" >Realizar envío</button>
</div>
