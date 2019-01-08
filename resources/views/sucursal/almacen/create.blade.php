<form @submit.prevent="submitFormAlmacen">
    <div class="form-group row mb-2">
        <label for="txtCodigo" class="col-sm-3 text-right control-label col-form-label">Codigo : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control"
                   v-model="almacen.attributes.codigo"
                   id="txtCodigo" placeholder="El código o nombre único del almacen aquí" name="txtCodigo">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtDireccion" class="col-sm-3 text-right control-label col-form-label">Direccion : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control"
                   v-model="almacen.attributes.direccion"
                   id="txtDireccion" placeholder="La dirección dónde está ubicado el almacen aquí" name="txtDireccion">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="cbxSucursal" class="col-sm-3 text-right control-label col-form-label">Sucursal : </label>
        <div class="col-sm-8">
            <select class="custom-select" id="cbxSucursal"
                    v-model="almacen.attributes.id_sucursal"
                    name="cbxCargo">
                <option v-for="almacen in almacen.sucursales" :value="almacen.id_sucursal">
                    @{{ almacen.nombre }}
                </option>
            </select>
        </div>
    </div>
    <div class="form-group text-center" >
        <button v-if="!almacen.attributes.id_almacen" type="submit" class="btn btn-primary w-25">Registrar</button>
        <div v-else>
            <button type="submit" class="btn btn-primary w-25">Actualizaar</button>
            <button type="button" class="btn btn-warning w-25" @click="cancelModeEditEmpresaSucursal" >Cancelar</button>
        </div>
    </div>
</form>