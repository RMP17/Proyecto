<form @submit.prevent="submitFormKardexObservaciones">
	<input type="hidden" id="cbxKardex" name="cbxKardex" >
	<div class="form-group row">
		<label for="txtObservacion" class="col-sm-2 text-right control-label col-form-label">Observación : </label>
		<div class="col-sm-6">
			<input type="text"
				   class="form-control"
				   id="txtObservacion"
				   v-model="kardex.kardex_observaciones.attributes.observacion"
				   placeholder="La observación aquí" name="txtObservacion">
		</div>
		<div class="col-sm-4">
			<button v-if="!kardex.kardex_observaciones.attributes.id_kardex_observaciones" type="submit" class="btn btn-primary">Registrar</button>
			<div v-else>
				<button type="submit" class="btn btn-primary">Actualizaar</button>
				<button type="button" class="btn btn-warning" @click="cancelModeEditKardexObserbacion" >Cancelar</button>
			</div>
		</div>
	</div>
</form>