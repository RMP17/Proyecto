<form class="form-horizontal" @submit.prevent="submitFormMoneda">
		<div class="form-group row mb-2">
			<label for="txtNombreMoneda"
				   class="col-sm-2 control-label col-form-label">Nombre:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control"
					   id="txtNombreMoneda"
					   v-model="moneda.attributes.nombre"
					   placeholder="El nombre de la moneda va aquí" name="nombre">
			</div>
		</div>
		<div class="form-group row mb-2">
			<label for="txtCodigoMoneda"
				   class="col-sm-2 control-label col-form-label">Código:</label>
			<div class="col-sm-10">
				<input type="text" class="form-control"
					   id="txtCodigoMoneda"
					   v-model="moneda.attributes.codigo"
					   placeholder="El códigp de la moneda va aquí" name="codigo">
			</div>
		</div>
		<div class="form-group row mb-2">
			<label class="col-sm-2 control-label col-form-label">País:</label>
			<div class="col-sm-10">
                <div v-if="!moneda.attributes.id_moneda">
                    <app-online-suggestions-objects v-if="!moneda.hideSuggestions" :config="pais.config"
                                            @selected-suggestion-event="assignAnIdentificationToTheCcurrency">
                    </app-online-suggestions-objects>
                </div>
                <div v-else>
                    <app-online-suggestions-objects v-if="!moneda.hideSuggestions" :config="pais.config"
                                            :input-value="moneda.tempAttributes.pais.nombre"
                                            @selected-suggestion-event="assignAnIdentificationToTheCcurrency">
                    </app-online-suggestions-objects>
                </div>
			</div>
		</div>
		<div class="col-12 text-center">
			<button v-if="!moneda.attributes.id_moneda" type="submit" class="btn btn-primary">Registrar</button>
			<button v-else type="submit" class="btn btn-primary">Actualizaar</button>
		</div>
</form>

