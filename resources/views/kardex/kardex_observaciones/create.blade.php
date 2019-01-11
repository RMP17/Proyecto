<form @submit.prevent="registerAcceso">
	<div class="form-group row">
		<div class="col-sm-5">
			<label for="txtUsuario">Usuario</label>
			<input type="text"
				   class="form-control"
				   id="txtUsuario"
				   v-model="acceso.attributes.usuario"
				   placeholder="Nombre de Usuario">
		</div>
		<div class="col-sm-5">
			<label for="txtUsuario">Contraseña</label>
			<input type="text"
				   class="form-control"
				   id="txtObservacion"
				   v-model="acceso.attributes.pass"
				   placeholder="Contraseña">
		</div>
		<div class="col-sm-2">
			<label class="invisible">-</label>
            <button v-if="!acceso.attributes.id_empleado" type="submit" class="btn btn-primary w-100">Registrar</button>
            <div v-else>
                <button type="submit" class="btn btn-primary">Actualizaar</button>
                <button type="button" class="btn btn-warning" @click="cancelModeEditKardexObserbacion" >Cancelar</button>
            </div>
        </div>
	</div>
</form>