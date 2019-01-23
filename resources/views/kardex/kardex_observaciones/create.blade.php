<form @submit.prevent="submitFormAcceso">
	<div class="form-group row">
		<div class="col">
			<label for="txtUsuario">Usuario</label>
			<input type="text"
				   class="form-control"
				   id="txtUsuario"
				   v-model="acceso.attributes.usuario"
				   placeholder="Nombre de Usuario">
		</div>
		<div class="col">
			<label for="txtUsuario">Contraseña</label>
			<input type="text"
				   class="form-control"
				   id="txtObservacion"
				   v-model="acceso.attributes.pass"
				   placeholder="Contraseña">
		</div>
		<div class="col">
			<label class="invisible">-</label>
            <button v-if="!acceso.attributes.id_empleado" type="submit" class="btn btn-primary w-100">Registrar</button>
            <div v-else>
                <button type="submit" class="btn btn-primary w-100">Actualizar</button>
            </div>
        </div>
	</div>
</form>