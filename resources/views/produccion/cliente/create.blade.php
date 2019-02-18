<form @submit.prevent="registerCliente" autocomplete="off">
    <div class="form-group row mb-2">
        <label for="txtRazonSocial" class="col-sm-4 text-right control-label col-form-label">Razón
            social : </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="txtRazonSocial"
                   v-model="produccion.cliente.attributes.razon_social"
                   placeholder="La razón social del cliente va aquí" name="txtRazonSocial">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtNit" class="col-sm-4 text-right control-label col-form-label">Cédula de identidad
            o NIT : </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="txtNit"
                   v-model="produccion.cliente.attributes.nit"
                   placeholder="La cédula de identidad del empleado aquí" name="txtNit">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtActividad" class="col-sm-4 text-right control-label col-form-label">Actividad
            : </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="txtActividad"
                   v-model="produccion.cliente.attributes.actividad"
                   placeholder="La cédula de identidad del empleado aquí" name="txtActividad">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtTelefono" class="col-sm-4 text-right control-label col-form-label">Teléfono
            : </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="txtTelefono"
                   v-model="produccion.cliente.attributes.telefono"
                   placeholder="Número telefónico del empleado aquí" name="txtTelefono"
                   onkeypress="return ValidarNumeroTecleado(event)">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtCelular" class="col-sm-4 text-right control-label col-form-label">Celular
            : </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="txtCelular"
                   v-model="produccion.cliente.attributes.celular"
                   placeholder="Número del celular del empleado aquí" name="txtCelular"
                   onkeypress="return ValidarNumeroTecleado(event)">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtCorreo" class="col-sm-4 text-right control-label col-form-label" id="lblCorreo">Correo
            : </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="txtCorreo"
                   v-model="produccion.cliente.attributes.correo"
                   placeholder="e-mail del empleado aquí" name="txtCorreo">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtDireccion" class="col-sm-4 text-right control-label col-form-label">Dirección
            : </label>
        <div class="col-sm-6">
            <input type="text" class="form-control" id="txtDireccion"
                   v-model="produccion.cliente.attributes.direccion"
                   placeholder="Dirección del empleado aquí" name="txtDireccion">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="cbxCiudad" class="col-sm-4 text-right control-label col-form-label">Ciudad
            : </label>
        <div class="col-sm-6">
            <app-online-suggestions-objects v-if="!produccion.hideSuggestionsCiudad" :config="configCiudad"
                                            @selected-suggestion-event="selectCiudad">
            </app-online-suggestions-objects>
        </div>
    </div>
    <div class="form-group text-center m-0 p-0">
        <button type="submit" class="btn btn-primary">Registrar</button>
    </div>
</form>