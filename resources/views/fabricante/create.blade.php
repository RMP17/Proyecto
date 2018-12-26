<div class="container-fluid">
	<div v-if="fabricante.errors.length > 0" class="alert alert-danger" role="alert">
		<li v-for="error in fabricante.errors"> @{{error}}</li>
	</div>
	<form class="form-horizontal" @submit.prevent="submitFormFabricante">
		<div class="form-group row">
			<label for="txtNombre" class="col-sm-3 text-right control-label col-form-label">Nombre : </label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="txtNombre"
					   placeholder="Nombre del fabricante que desea registrar" name="nombre"
					   v-model="fabricante.attributes.nombre"
				>
			</div>
		</div>
		<div class="form-group row">
			<label for="txtContacto" class="col-sm-3 text-right control-label col-form-label">Contacto : </label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="txtContacto"
					   placeholder="Número de contacto del fabricante aquí" name="txtContacto"
					   onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)"
					   v-model="fabricante.attributes.contacto"
				>
			</div>
		</div>
		<div class="form-group row">
			<label for="txtSitioWeb" class="col-sm-3 text-right control-label col-form-label" id="lblSitioWeb">Sitio web : </label>
			<div class="col-sm-9">
				<input type="text" class="form-control" id="txtSitioWeb"
					   placeholder="Sitio web del fabricante aquí" name="sitio_web"
					   v-model="fabricante.attributes.sitio_web"
				>
				<label for="txtSitioWeb" class="col-sm-3 text-right control-label col-form-label" id="msmSitioWeb"></label>
			</div>
		</div>
		<div v-if="!fabricante.modeEdit" class="form-group text-center">
			<button class="btn btn-primary w-25" type="submit">Registrar</button>
		</div>
		<div v-else class="form-group text-center">
			<button class="btn btn-primary w-25" type="submit">Actualizar</button>
			<button type="button" class="btn btn-warning w-25" @click="cancelEditModeFabricante">Cancelar</button>
		</div>
	</form>
</div>

