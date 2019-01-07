<form class="form-horizontal" @submit.prevent="submitFormCuentaProveedor">
    <div class="form-group row mb-2">
        <label for="txtEntidad"
               class="col-sm-2 text-right control-label col-form-label">Entidad : </label>
        <div class="col-sm-9">
            <input type="text"
                   class="form-control"
                   id="txtEntidad"
                   v-model="cuenta_proveedor.attributes.entidad"
                   placeholder="La entidad bancaría aquí"
                   name="txtEntidad">
        </div>
    </div>
    <div class="form-group row">
        <label for="txtNroCuenta" class="col-sm-2 text-right control-label col-form-label">Nro. Cuenta : </label>
        <div class="col-sm-9">
            <input type="text"
                   class="form-control"
                   id="txtNroCuenta"
                   v-model="cuenta_proveedor.attributes.nro_cuenta"
                   placeholder="El número de la cuenta aquí"
                   name="txtNroCuenta">
        </div>
    </div>
    <div class="form-group row">
        <label for="cbxMoneda" class="col-sm-2 text-right control-label col-form-label">Moneda : </label>
        <div class="col-sm-9">
            <select class="custom-select"
                    @change="assignMonedaCuenta($event)"
                    v-model="cuenta_proveedor.attributes.id_moneda"
                    name="cbxMoneda">
                <option v-for="_moneda in cuenta_proveedor.monedas" :value="_moneda.id_moneda">
                    @{{ _moneda.nombre }}  -  @{{ _moneda.codigo }}
                </option>
            </select>
        </div>
    </div>
    <div class="form-group text-center" >
        <button v-if="!cuenta_proveedor.attributes.id_cuenta" type="submit" class="btn btn-primary w-25">Registrar</button>
        <div v-else>
            <button type="submit" class="btn btn-primary w-25">Actualizaar</button>
            <button type="button" class="btn btn-warning w-25" @click="cancelModeEditProveedor" >Cancelar</button>
        </div>
    </div>
</form>
