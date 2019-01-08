<form @submit.prevent="submitFormEmpresaSucursal">
    <div class="form-group row mb-2">
        <label for="txtNombre" class="col-sm-3 text-right control-label col-form-label">Nombre: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control"
                   v-model="empresa_sucursal.attributes.nombre"
                   id="txtNombre" placeholder="El nombre de la sucursal aquí" name="txtNombre">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="rbtCasaMatriz0" class="col-sm-3 text-right control-label col-form-label">Casa Matriz : </label>
        <div class="col-sm-8">
            <div class="form-control">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox"
                           v-model="empresa_sucursal.attributes.casa_matriz"
                           true-value=1
                           false-value=0
                           class="custom-control-input" id="customCheck1CasaMatriz">
                    <label v-if="empresa_sucursal.attributes.casa_matriz==1" class="custom-control-label w-100 pt-1" for="customCheck1CasaMatriz">Si</label>
                    <label v-else class="custom-control-label w-100 pt-1" for="customCheck1CasaMatriz">No</label>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtDireccion" class="col-sm-3 text-right control-label col-form-label">Dirección : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control"
                   v-model="empresa_sucursal.attributes.direccion"
                   id="txtDireccion" placeholder="Dirección de la sucursal aquí" name="txtDireccion">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtTelefono" class="col-sm-3 text-right control-label col-form-label">Teléfono : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control"
                   v-model="empresa_sucursal.attributes.telefono"
                   id="txtTelefono" placeholder="Número telefónico de la sucursal aquí" name="txtTelefono" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="dateFechas" class="col-sm-3 text-right control-label col-form-label">Fecha Apertura : </label>
        <div class="col-sm-8">
            <input type="date" class="form-control"
                   v-model="empresa_sucursal.attributes.fecha_apertura"
                   name="fecha_apertura" id="dateFechas">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="cbxCiudad" class="col-sm-3 text-right control-label col-form-label">Ciudad : </label>
        <div class="col-sm-8">
            <div v-if="!empresa_sucursal.attributes.id_sucursal">
                <app-online-suggestions-objects v-if="!empresa_sucursal.hideSuggestions" :config="empresa_sucursal.config"
                                                @selected-suggestion-event="assignAnIdentificationToTheSucursal">
                </app-online-suggestions-objects>
            </div>
            <div v-else>
                <app-online-suggestions-objects v-if="!empresa_sucursal.hideSuggestions" :config="empresa_sucursal.config"
                                                :input-value="empresa_sucursal.attributes.ciudad.pais_ciudad"
                                                @selected-suggestion-event="assignAnIdentificationToTheSucursal">
                </app-online-suggestions-objects>
            </div>
        </div>
    </div>
    <div class="form-group text-center" >
        <button v-if="!empresa_sucursal.attributes.id_sucursal" type="submit" class="btn btn-primary w-25">Registrar</button>
        <div v-else>
            <button type="submit" class="btn btn-primary w-25">Actualizaar</button>
            <button type="button" class="btn btn-warning w-25" @click="cancelModeEditEmpresaSucursal" >Cancelar</button>
        </div>
    </div>
</form>