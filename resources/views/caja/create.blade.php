<form class="form-horizontal" @submit.prevent="submitFormCaja">
    <div class="form-group row mb-2">
        <label for="txtNombre"
               class="col-sm-3 control-label col-form-label">Nombre:</label>
        <div class="col-sm-9">
            <input type="text" class="form-control"
                   id="txtNombre"
                   autocomplete="off"
                   v-model="caja.attributes.nombre"
                   placeholder="Nombre de la caja" >
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-3 control-label col-form-label">Empleado:</label>
        <div class="col-sm-9">
            <div v-if="!caja.attributes.id_caja">
                <app-online-suggestions-objects v-if="!caja.hideSuggestions" :config="configEmpleado"
                                                @selected-suggestion-event="selectEmpleado">
                </app-online-suggestions-objects>
            </div>
            <div v-else>
                <app-online-suggestions-objects v-if="!caja.hideSuggestions" :config="configEmpleado"
                                                :input-value="caja.tempAttributes.empleado.nombre"
                                                @selected-suggestion-event="selectEmpleado">
                </app-online-suggestions-objects>
            </div>
        </div>
    </div>
    <div class="col-12 text-center">
        <button v-if="!caja.attributes.id_caja" type="submit" class="btn btn-primary">Registrar</button>
        <button v-else type="submit" class="btn btn-primary">Actualizar</button>
    </div>
</form>

