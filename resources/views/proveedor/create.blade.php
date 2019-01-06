{{--<div v-if="articulo.errors.length > 0" class="alert alert-danger" role="alert">
    <li v-for="error in articulo.errors"> @{{error}}</li>
</div>--}}
<form class="form-horizontal" @submit.prevent="submitFormProveedor">
    <div class="form-group row mb-2">
        <label for="txtRazonSocial"
               class="col-sm-3 text-right control-label col-form-label">Razón Social (*): </label>
        <div class="col-sm-8">
            <input type="text" class="form-control"
                   id="txtRazonSocial"
                   v-model="proveedor.attributes.razon_social"
                   placeholder="Razón social del proveedor" name="RazonSocial">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtNit"
               class="col-sm-3 text-right control-label col-form-label">NIT (*): </label>
        <div class="col-sm-8">
            <input type="text" class="form-control"
                   id="txtNit"
                   placeholder="El NIT del Proveedor aquí"
                   v-model="proveedor.attributes.nit"
                   name="txtNit">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="cbxCiudad" class="col-sm-3 text-right control-label col-form-label">Ciudad : </label>
        <div class="col-sm-8">
            <div v-if="!proveedor.attributes.id_proveedor">
                <app-online-suggestions-objects v-if="!proveedor.hideSuggestions" :config="proveedor.config"
                                                @selected-suggestion-event="assignAnIdentificationToTheProvider">
                </app-online-suggestions-objects>
            </div>
            <div v-else>
                <app-online-suggestions-objects v-if="!proveedor.hideSuggestions" :config="proveedor.config"
                                                :input-value="proveedor.tempAttributes.ciudad.pais_ciudad"
                                                @selected-suggestion-event="assignAnIdentificationToTheProvider">
                </app-online-suggestions-objects>
            </div>
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtTelefono" class="col-sm-3 text-right control-label col-form-label">Teléfono : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control"
                   id="txtTelefono"
                   placeholder="Número telefónico del proveedor aquí"
                   name="txtTelefono"
                   v-model="proveedor.attributes.telefono"
                   onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtFax" class="col-sm-3 text-right control-label col-form-label">Fax : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control"
                   id="txtFax"
                   placeholder="El fax del proveedor aquí"
                   name="txtfax"
                   v-model="proveedor.attributes.fax">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtCelular" class="col-sm-3 text-right control-label col-form-label">Celular : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="txtCelular"
                   placeholder="Número del celular del proveedor aquí" name="txtCelular"
                   v-model="proveedor.attributes.celular"
                   onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtCorreo" class="col-sm-3 text-right control-label col-form-label"
               id="lblCorreo">Correo : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="txtCorreo"
                   placeholder="E-mail del proveedor aquí"
                   v-model="proveedor.attributes.correo"
                   name="txtCorreo">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtSitioWeb" class="col-sm-3 text-right control-label col-form-label"
               id="lblSitioWeb">Sitio web : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="txtSitioWeb"
                   placeholder="Sitio web del proveedor aquí"
                   v-model="proveedor.attributes.sitio_web"
                   name="txtSitioWeb" onblur="ValidarSitioWeb(event, this.id)">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtDireccion" class="col-sm-3 text-right control-label col-form-label">Dirección : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control"
                   id="txtDireccion" placeholder="Dirección del proveedor aquí"
                   v-model="proveedor.attributes.direccion"
                   name="txtDireccion">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtRubro" class="col-sm-3 text-right control-label col-form-label">Rubro : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="txtRubro"
                   placeholder="El rubro del proveedor aquí"
                   v-model="proveedor.attributes.rubro"
                   name="txtRubro">
        </div>
    </div>
    {{--<div class="form-group row mb-2">
        <label for="cbxPais" class="col-sm-3 text-right control-label col-form-label">País : </label>
        <div class="col-sm-8">
            <select class="form-control custom-select" style="width: 100%; height:36px;" id="cbxPais"
                    name="cbxPais">
                <option>País...</option>
            </select>
        </div>
    </div>--}}
    <div class="form-group text-center m-0 p-0">
        <button v-if="!proveedor.attributes.id_proveedor" type="submit" class="btn btn-primary">Registrar</button>
        <button v-else type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>
