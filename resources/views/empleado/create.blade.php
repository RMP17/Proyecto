<form @submit.prevent="submitFormEmpleado">
	<div class="card-group mb-0">
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Datos de registro del empleado</h4>
				<div class="form-group mb-2 row">
					<label for="txtNombre" class="col-sm-5 text-right control-label col-form-label">Nombre completo : </label>
					<div class="col-sm-7">
						<input type="text"
							   class="form-control"
							   v-model="empleado.attributes.nombre"
							   id="txtNombre" placeholder="El nombre completo del empleado aquí" name="txtNombre">
					</div>
				</div>
				<div class="form-group mb-2 row">
					<label for="txtCi" class="col-sm-5 text-right control-label col-form-label">Cédula de identidad o NIT : </label>
					<div class="col-sm-7">
						<input type="text"
							   class="form-control"
							   v-model="empleado.attributes.ci"
							   id="txtCi" placeholder="La cédula de identidad del empleado aquí" name="txtCi">
					</div>
				</div>
				<div class="form-group mb-2 row">
					<label for="rbtSexo0" class="col-sm-5 text-right control-label col-form-label">Sexo : </label>
					<div class="col-sm-7">
						<div class="form-control">
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio" class="custom-control-input"
									   id="rbtSexo0" name="rbtSexo"
									   v-model="empleado.attributes.sexo"
									   :value="'m'">
								<label class="custom-control-label pt-1" for="rbtSexo0">Masculino</label>
							</div>
							<div class="custom-control custom-radio custom-control-inline">
								<input type="radio"
									   class="custom-control-input"
									   v-model="empleado.attributes.sexo"
									   :value="'f'"
									   id="rbtSexo1" name="rbtSexo">
								<label class="custom-control-label pt-1" for="rbtSexo1">Femenino</label>
							</div>
						</div>
					</div>
				</div>
				<div class="form-group mb-2 row">
					<label for="dateFechaNacimiento" class="col-sm-5 text-right control-label col-form-label">Fecha de nacimiento : </label>
					<div class="col-sm-7">
						<input type="date"
							   id="dateFechaNacimiento"
							   class="form-control"
							   v-model="empleado.attributes.fecha_nacimiento"
							   name="dtmFechaNacimiento">
					</div>
				</div>
				<div class="form-group mb-2 row">
					<label for="txtTelefono" class="col-sm-5 text-right control-label col-form-label">Teléfono : </label>
					<div class="col-sm-7">
						<input type="text"
							   class="form-control"
							   v-model="empleado.attributes.telefono"
							   id="txtTelefono" placeholder="Número telefónico del empleado aquí" name="txtTelefono" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)">
					</div>
				</div>
				<div class="form-group mb-2 row">
					<label for="txtCelular" class="col-sm-5 text-right control-label col-form-label">Celular : </label>
					<div class="col-sm-7">
						<input type="text"
							   class="form-control"
							   id="txtCelular"
							   v-model="empleado.attributes.celular"
							   placeholder="Número del celular del empleado aquí" name="txtCelular" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)">
					</div>
				</div>
				<div class="form-group mb-2 row">
					<label for="txtCorreo" class="col-sm-5 text-right control-label col-form-label" id="lblCorreo">Correo : </label>
					<div class="col-sm-7">
						<input type="text"
							   class="form-control"
							   id="txtCorreo"
							   v-model="empleado.attributes.correo"
							   placeholder="e-mail del empleado aquí" name="txtCorreo" onblur="ValidarCorreo(event, 'txtCorreo')">
					</div>
				</div>
				<div class="form-group mb-2 row">
					<label for="txtDireccion" class="col-sm-5 text-right control-label col-form-label">Dirección : </label>
					<div class="col-sm-7">
						<input type="text"
							   class="form-control"
							   id="txtDireccion"
							   v-model="empleado.attributes.direccion"
							   placeholder="Dirección del empleado aquí" name="txtDireccion">
					</div>
				</div>
				<div class="form-group mb-2 row">
					<label for="imgFoto" class="col-sm-5 text-right control-label col-form-label">Fotografía : </label>
					<div class="col-sm-7">
						<div class="custom-file">
							<input type="file" class="custom-file-input" id="imgImagen"
								   accept="image/jpg,image/jpeg,image/png" @change="handleFileUpload($event)">
							<label class="custom-file-label" for="validatedCustomFile">Fotografía formato .jpeg aquí</label>
							<div class="invalid-feedback">Archivo inválido</div>
						</div>
					</div>
				</div>
				<div class="form-group mb-2 row">
					<label for="cbxSucursal" class="col-sm-5 text-right control-label col-form-label">Sucursal : </label>
					<div class="col-sm-7">
						<select class="custom-select" id="cbxSucursal"
								v-model="empleado.attributes.id_sucursal"
								name="cbxCargo">
							<option v-for="sucursal in almacen.sucursales" :value="sucursal.id_sucursal">
								@{{ sucursal.nombre }}
							</option>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<h4 class="card-title">Otros datos</h4>
				<div class="form-group mb-2 row">
					<label for="selectCargo" class="col-sm-3 text-right control-label col-form-label">Cargo : </label>
					<div class="col-sm-8">
						<select class="custom-select" id="selectCargo"
								v-model="empleado.attributes.kardex.id_cargo"
								name="cbxCargo">
							<option v-for="_cargo in cargo.data" :value="_cargo.id_cargo">
								@{{ _cargo.nombre }}
							</option>
						</select>
					</div>
				</div>
				<div class="form-group mb-2 row">
					<label for="dateFechaInicio" class="col-sm-3 text-right control-label col-form-label">Fecha de inicio: </label>
					<div class="col-sm-8">
						<input type="date"
							   id="dateFechaInicio"
							   class="form-control"
							   v-model="empleado.attributes.kardex.fecha_inicio"
							   name="dtmFechaNacimiento">
					</div>
				</div>
				<h4 class="card-title">Salario</h4>
				<div class="form-group mb-2 row">
					<label for="txtMonto" class="col-sm-3 text-right control-label col-form-label">Monto : </label>
					<div class="col-sm-8">
						<input type="text"
							   class="form-control"
							   v-model="empleado.attributes.kardex.salario.monto"
							   id="txtMonto">
					</div>
				</div>
				<div class="form-group mb-2 row">
					<label for="cbxMoneda" class="col-sm-3 text-right control-label col-form-label">Moneda : </label>
					<div class="col-sm-8">
						<select class="custom-select" id="cbxMoneda"
								v-model="empleado.attributes.kardex.salario.id_moneda"
								name="cbxCargo">
							<option v-for="_moneda in moneda.data" :value="_moneda.id_moneda">
								@{{ _moneda.nombre }}
							</option>
						</select>
					</div>
				</div>
				<h4 class="card-title">Datos de contacto de referencia del empleado</h4>
				<div class="form-group mb-2 row">
					<label for="txtPersonaReferencia" class="col-sm-3 text-right control-label col-form-label">Nombre del contacto : </label>
					<div class="col-sm-8 ">
						<input type="text"
							   class="form-control mt-2"
							   id="txtPersonaReferencia"
							   v-model="empleado.attributes.persona_referencia"
							   placeholder="Nombre de un contacto de referencia aquí" name="txtPersonaReferencia">
					</div>
				</div>
				<div class="form-group mb-2 row">
					<label for="txtTelefonoReferencia" class="col-sm-3 text-right control-label col-form-label">Teléfono del contacto : </label>
					<div class="col-sm-8">
						<input type="text"
							   class="form-control mt-2"
							   id="txtTelefonoReferencia"
							   v-model="empleado.attributes.telefono_referencia"
							   placeholder="Teléfono del contacto de referencia aquí" name="txtTelefonoReferencia" onkeypress="return ValidarNumeroTecleado(event)">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="form-group text-center" >
		<button v-if="!empleado.attributes.id_empleado" type="submit" class="btn btn-primary w-25">Registrar</button>
		<div v-else>
			<button type="submit" class="btn btn-primary w-25">Actualizaar</button>
			<button type="button" class="btn btn-warning w-25" @click="cancelModeEditEmpleado" >Cancelar</button>
		</div>
	</div>

</form>
