<form class="form-horizontal" @submit.prevent="submitFormCargo">
	<div class="form-group row mb-2">
		<label for="txtNombreCargo"
			   class="col-sm-2 control-label col-form-label">Nombre:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control"
				   id="txtNombreCargo"
				   v-model="cargo.attributes.nombre"
				   placeholder="Nombre del Cargo" name="nombre">
		</div>
	</div>
	<div class="col-12 text-center">
		<button v-if="!cargo.attributes.id_cargo" type="submit" class="btn btn-primary">Registrar</button>
		<button v-else type="submit" class="btn btn-primary">Actualizaar</button>
	</div>
</form>

