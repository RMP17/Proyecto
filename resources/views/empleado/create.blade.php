
<div class="container-fluid">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
       @if (count($errors) > 0)
			<div class="alert alert-danger">
				<ul>
					@foreach ($errors->all() as $error)
						<li> {{$error}} </li>
					@endforeach
				</ul>
			</div>
		@endif
	{!!Form::open(array('class' => 'form-horizontal', 'url' => 'empleado', 'method' => 'POST', 'autocomplete' => 'off'))!!}
	 {{Form::token()}}
		<div class="card-group">
			<div class="card">	
				<div class="card-body">
					<h4 class="card-title">Datos de registro del empleado</h4>
					<div class="form-group row">
						<label for="txtNombre" class="col-sm-3 text-right control-label col-form-label">Nombre completo : </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="txtNombre" placeholder="El nombre completo del empleado aquí" name="txtNombre">
						</div>
					</div>
					<div class="form-group row">
						<label for="txtCi" class="col-sm-3 text-right control-label col-form-label">Cédula de identidad o NIT : </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="txtCi" placeholder="La cédula de identidad del empleado aquí" name="txtCi">
						</div>
					</div>
					<div class="form-group row">
						<label for="rbtSexo0" class="col-sm-3 text-right control-label col-form-label">Sexo : </label>
						<div class="col-sm-9">
							<div class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" id="rbtSexo0" name="rbtSexo" required checked value = 'm'>
								<label class="custom-control-label" for="rbtSexo0">Masculino</label>
							</div>
							<div class="custom-control custom-radio">
								<input type="radio" class="custom-control-input" id="rbtSexo1" name="rbtSexo" required value = 'f'>
								<label class="custom-control-label" for="rbtSexo1">Femenino</label>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="datepickerId" class="col-sm-3 text-right control-label col-form-label">Fecha de nacimiento : </label>
						<div class="col-sm-9">
							<div class="input-group">
								<input type="text" class="form-control datepicker" id="datepickerId" placeholder="yyyy/mm/dd" name="dtmFechaNacimiento">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="txtTelefono" class="col-sm-3 text-right control-label col-form-label">Teléfono : </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="txtTelefono" placeholder="Número telefónico del empleado aquí" name="txtTelefono" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)">
						</div>
					</div>
					<div class="form-group row">
						<label for="txtCelular" class="col-sm-3 text-right control-label col-form-label">Celular : </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="txtCelular" placeholder="Número del celular del empleado aquí" name="txtCelular" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)">
						</div>
					</div>
					<div class="form-group row">
						<label for="txtCorreo" class="col-sm-3 text-right control-label col-form-label" id="lblCorreo">Correo : </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="txtCorreo" placeholder="e-mail del empleado aquí" name="txtCorreo" onblur="ValidarCorreo(event, 'txtCorreo')">
							<label for="txtCorreo" class="col-sm-3 text-right control-label col-form-label" id="msmCorreo"></label>
						</div>
					</div>
					<div class="form-group row">
						<label for="txtDireccion" class="col-sm-3 text-right control-label col-form-label">Dirección : </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="txtDireccion" placeholder="Dirección del empleado aquí" name="txtDireccion">
						</div>
					</div>
					<div class="form-group row">
						<label for="imgFoto" class="col-sm-3 text-right control-label col-form-label">Fotografía : </label>
						<div class="col-sm-9">
							<input type="file" class="custom-file-input" id="imgFoto" accept="image/jpeg">
							<label class="custom-file-label" for="imgFoto">Carga una foto del empleado en formato .jpeg aquí</label>
							<div class="invalid-feedback">Archivo inválido</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="cbxPais" class="col-sm-3 text-right control-label col-form-label">País : </label>
						<div class="col-sm-9">
							<div class="col-md-9">
								<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxPais" name="cbxPais">
									
									@foreach($paises as $p)
										<option value={{$p -> id_pais}}>{{$p ->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="cbxCiudad" class="col-sm-3 text-right control-label col-form-label">Ciudad : </label>
						<div class="col-sm-9">
							<div class="col-md-9">
								<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxCiudad" name="cbxCiudad">
								
								</select>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="cbxSucursal" class="col-sm-3 text-right control-label col-form-label">Sucursal : </label>
						<div class="col-sm-9">
							<div class="col-md-9">
								<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxSucursal" name="cbxSucursal">
									
								</select>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card">
				<div class="card-body">
					<h4 class="card-title">Otros datos</h4>
					<div class="form-group row">
						<label for="cbxCargo" class="col-sm-3 text-right control-label col-form-label">Cargo : </label>
						<div class="col-sm-9">
							<div class="col-md-9">
								<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxCargo" name="cbxCargo">		
									@foreach($cargos as $c)
										<option value={{$c -> id_cargo}}>{{$c ->nombre}}</option>
									@endforeach
									<option </option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="datepicker-autoclose" class="col-sm-3 text-right control-label col-form-label">Fecha de inicio: </label>
						<div class="col-sm-9">
							<div class="input-group date" >
							    <input type="text" class="form-control datepicker" placeholder="yyyy/mm/dd" name="dtmFecha_inicio">
							    <div class="input-group-append">
									<span class="input-group-text"><i class="fa fa-calendar"></i></span>
								</div>
						   </div>
						</div>
					</div>
					<h4 class="card-title">Salario</h4>
					<div class="form-group row">
						<label for="txtMonto" class="col-sm-3 text-right control-label col-form-label">Monto : </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="txtMonto" placeholder="" name="txtMonto">
						</div>
					</div>
					<div class="form-group row">
						<label for="cbxMoneda" class="col-sm-3 text-right control-label col-form-label">Moneda : </label>
						<div class="col-sm-9">
							<div class="col-md-9">
								<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxMoneda" name="cbxMoneda">
									<option>Moneda...</option>
									@foreach($monedas as $m)
										<option value={{$m -> id_moneda}}>{{$m ->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<h4 class="card-title">Datos de contacto de referencia del empleado</h4>
					<div class="form-group row">
						<label for="txtPersonaReferencia" class="col-sm-3 text-right control-label col-form-label">Nombre del contacto : </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="txtPersonaReferencia" placeholder="Nombre de un contacto de referencia aquí" name="txtPersonaReferencia">
						</div>
					</div>
					<div class="form-group row">
						<label for="txtTelefonoReferencia" class="col-sm-3 text-right control-label col-form-label">Teléfono del contacto : </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="txtTelefonoReferencia" placeholder="Teléfono del contacto de referencia aquí" name="txtTelefonoReferencia" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)">
						</div>
					</div>
				</div>
				<div class="border-top">
					<div class="card-body">
						<button type="submit" class="btn btn-primary">Registrar</button>
						<button type="reset" class="btn btn-danger">Cancelar</button>
					</div>
				</div>		
			</div>		
		</div>	
	{!!Form::close()!!}
</div>