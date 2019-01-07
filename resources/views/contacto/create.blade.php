<form @submit.prevent="registerContacto">
    <div class="form-group row mb-2">
        <label for="txtNombre" class="col-sm-3 text-right control-label col-form-label">Nombre (*): </label>
        <div class="col-md-7">
            <input type="text" class="form-control"
                   id="txtNombre"
                   v-model="contacto.attributes.nombre"
                   placeholder="Nombre del contacto aquí"
                   name="txtNombre">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtTelefono" class="col-sm-3 text-right control-label col-form-label">Teléfono : </label>
        <div class="col-md-7">
            <input type="text" class="form-control" id="txtTelefono"
                   placeholder="Número telefónico del contacto aquí"
                   v-model="contacto.attributes.telefono"
                   name="txtTelefono" onkeypress="return ValidarNumeroTecleado(event)"
                   onblur="ValidarNumeroPegado(event, this.id)">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtInterno" class="col-sm-3 text-right control-label col-form-label">Teléfono interno : </label>
        <div class="col-md-7">
            <input type="text" class="form-control" id="txtInterno"
                   placeholder="El número de contacto interno aquí"
                   v-model="contacto.attributes.interno"
                   name="txtInterno" onkeypress="return ValidarNumeroTecleado(event)"
                   onblur="ValidarNumeroPegado(event, this.id)">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtCelular" class="col-sm-3 text-right control-label col-form-label">Celular : </label>
        <div class="col-md-7">
            <input type="text" class="form-control" id="txtCelular"
                   placeholder="Número del celular del contacto aquí"
                   v-model="contacto.attributes.celular"
                   name="txtCelular" onkeypress="return ValidarNumeroTecleado(event)"
                   onblur="ValidarNumeroPegado(event, this.id)">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtCorreo" class="col-sm-3 text-right control-label col-form-label" id="lblCorreo">Correo : </label>
        <div class="col-md-7">
            <input type="text" class="form-control" id="txtCorreo"
                   placeholder="e-mail del contacto aquí"
                   v-model="contacto.attributes.correo"
                   name="txtCorreo">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="cbxProveedor" class="col-sm-3 text-right control-label col-form-label">Proveedor : </label>
        <div class="col-md-7">
            <div v-if="!contacto.attributes.id_contacto">
                <app-online-suggestions-objects v-if="!contacto.hideSuggestions" :config="contacto.configProveedor"
                                                @selected-suggestion-event="assignAnIdentificationToContactOfProveedor">
                </app-online-suggestions-objects>
            </div>
            <div v-else>
                <app-online-suggestions-objects v-if="!contacto.hideSuggestions" :config="contact.config"
                                                :input-value="contacto.tempAttributes.proveedor.nombre"
                                                @selected-suggestion-event="assignAnIdentificationToContactOfProveedor">
                </app-online-suggestions-objects>
            </div>
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="cbxCargo" class="col-sm-3 text-right control-label col-form-label">Cargo : </label>
        <div class="col-md-7">
            <select class="custom-select" id="cbxCargo"
                    v-model="contacto.attributes.id_cargo"
                    name="cbxCargo">
                <option v-for="cargo in contacto.cargos" :value="cargo.id_cargo">
                    @{{ cargo.nombre }}
                </option>
                {{--@foreach($cargos as $ca)
                    <option value={{$ca -> id_cargo}}>{{$ca ->nombre}}</option>
                @endforeach--}}
            </select>
        </div>
    </div>
    <div class="form-group text-center">
        <button v-if="!contacto.attributes.id_contacto" type="submit" class="btn btn-primary w-25">Registrar
        </button>
        <div v-else>
            <button type="submit" class="btn btn-primary w-25">Actualizaar</button>
            <button type="button" class="btn btn-warning w-25" @click="cancelModeEditProveedor">Cancelar</button>
        </div>
    </div>
</form>