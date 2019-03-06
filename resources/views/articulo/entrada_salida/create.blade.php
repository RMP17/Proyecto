<div class="form-group row">
        <label for="txtCategoria"
               class="col-sm-3 text-right control-label col-form-label">Árticulo: </label>
        <div class="col-sm-6">
            <app-online-suggestions-objects v-if="!entradaSalidaArticulos.hideSuggestions"
                    :config="articulo.config"
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
    <div class="form-group row">
        <label for="txtCategoria"
               class="col-sm-3 text-right control-label col-form-label">Observaciones: </label>
        <div class="col-sm-6">
            <textarea class="form-control"
                      v-model ="entradaSalidaArticulos.attributes.observaciones"
                      rows="2"
                      placeholder="Descripción del por que sale o entra el artículo"
            ></textarea>
        </div>
    </div>
    <div v-if="!entradaSalidaArticulos.modeEdit" class="form-group text-center">
        <button class="btn btn-primary w-25" type="submit"
                @click="submitFormEntradaSalidaArticulo('e')">Ingresar</button>
        <button class="btn btn-primary w-25" type="submit"
                @click="submitFormEntradaSalidaArticulo('s')">Sustraer</button>
    </div>
