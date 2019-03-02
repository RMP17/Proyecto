<form class="form-horizontal" @submit.prevent="submitFormCategoria">
    <div class="form-group row">
        <label for="txtCategoria"
               class="col-sm-3 text-right control-label col-form-label">Árticulo: </label>
        <div class="col-sm-6">
            <app-online-suggestions-objects :config="articulo.config"
                                            @selected-suggestion-event="selectArticuloForEntradaSalida">
            </app-online-suggestions-objects>
        </div>
    </div>
    <div class="form-group row">
        <label for="txtCategoria"
               class="col-sm-3 text-right control-label col-form-label">Álmacen: </label>
        <div class="col-sm-6">
            <select class="custom-select"
                    v-model="entradaSalidaArticulos.attributes.id_almacen"
                    name="cbxMoneda">
                <option :value="null" disabled>Seleccione Almacen</option>
                <option v-for="_almacen in almacenes" :value="_almacen.id_almacen">
                    @{{ _almacen.codigo }}
                </option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label for="txtCategoria"
               class="col-sm-3 text-right control-label col-form-label">Cantidad: </label>
        <div class="col-sm-6">
            <input type="text" class="form-control"
                   id="txtCantidad"
                   @keypress="numberPositiveDirective"
                   v-model.number ="entradaSalidaArticulos.attributes.cantidad"
                   placeholder="Cantidad" name="cantidad">
        </div>
    </div>
    <div v-if="!entradaSalidaArticulos.modeEdit" class="form-group text-center">
        <button class="btn btn-primary w-25" type="submit">Ingresar</button>
        <button class="btn btn-primary w-25" type="submit">Sustraer</button>
    </div>
    {{--<div v-else class="form-group text-center">
        <button class="btn btn-primary w-25" type="submit">Actualizar</button>
        <button type="button" class="btn btn-warning w-25" @click="cancelEditModeCategoria">Cancelar</button>
    </div>--}}
</form>