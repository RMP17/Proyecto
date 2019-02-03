<form @submit.prevent="submitFormPrecios">
    <div class="form-group row mb-2">
        <label for="cbxSucursal" class="col-sm-3 text-right control-label col-form-label">Sucursal : </label>
        <div class="col-sm-8">
            <select class="custom-select" id="cbxSucursal"
                    v-model.numeric="articulosSucursales.attributes.id_sucursal"
                    name="cbxCargo">
                <option :value='null' selected disabled> Seleccione una sucursal...</option>
                <option v-for="sucursal in sucursales" :value="sucursal.id_sucursal">
                    @{{ sucursal.nombre }}
                </option>
            </select>
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtPrecio1" class="col-sm-3 text-right control-label col-form-label">Precio 1 : </label>
        <div class="col-sm-8">
            <div class="input-group">
                <input type="text"
                       v-model="articulosSucursales.attributes.precio_1"
                       @keypress="numberPositiveDirective"
                       class="form-control"
                       id="txtPrecio1"
                       placeholder="00.00"
                       name="txtPrecio1">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Bs.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtPrecio2" class="col-sm-3 text-right control-label col-form-label">Precio 2 : </label>
        <div class="col-sm-8">
            <div class="input-group">
                <input type="text"
                       class="form-control"
                       v-model="articulosSucursales.attributes.precio_2"
                       @keypress="numberPositiveDirective"
                       id="txtPrecio2"
                       placeholder="00.00" name="txtPrecio2">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Bs.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtPrecio3" class="col-sm-3 text-right control-label col-form-label">Precio 3 : </label>
        <div class="col-sm-8">
            <div class="input-group">
                <input type="text"
                       class="form-control"
                       v-model="articulosSucursales.attributes.precio_3"
                       @keypress="numberPositiveDirective"
                       id="txtPrecio3"
                       placeholder="00.00" name="txtPrecio3">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Bs.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtPrecio4" class="col-sm-3 text-right control-label col-form-label">Precio 4 : </label>
        <div class="col-sm-8">
            <div class="input-group">
                <input type="text"
                       class="form-control"
                       v-model="articulosSucursales.attributes.precio_4"
                       @keypress="numberPositiveDirective"
                       id="txtPrecio4"
                       placeholder="00.00" name="txtPrecio4">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Bs.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtPrecio5" class="col-sm-3 text-right control-label col-form-label">Precio 5 : </label>
        <div class="col-sm-8">
            <div class="input-group">
                <input type="text"
                       class="form-control"
                       v-model="articulosSucursales.attributes.precio_5"
                       @keypress="numberPositiveDirective"
                       id="txtPrecio5" placeholder="00.00" name="txtPrecio5">
                <div class="input-group-append">
                    <span class="input-group-text" id="basic-addon2">Bs.</span>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group text-center" >
        <button v-if="!articulosSucursales.modeEdit" type="submit" class="btn btn-primary w-25">Registrar</button>
        <div v-else>
            <button type="submit" class="btn btn-primary w-25">Actualizar</button>
            <button type="button" class="btn btn-warning w-25" @click="cancelModeEditPrecios" >Cancelar</button>
        </div>
    </div>
</form>