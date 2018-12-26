@extends('maquetas.admin')
@section('page_wrapper')
	<body>
		<!-- ============================================================== -->
		<!-- Preloader - style you can find in spinners.css -->
		<!-- ============================================================== -->
		<div class="preloader">
			<div class="lds-ripple">
				<div class="lds-pos"></div>
				<div class="lds-pos"></div>
			</div>
		</div>
		<!-- ============================================================== -->
		<!-- Container fluid  -->
		<!-- ============================================================== -->
		<div class="container-fluid">
			<!-- ============================================================== -->
			<!-- Start Page Content -->
			<!-- ============================================================== -->
			<h2> Datos del empleado : {{$empleado -> nombre}} </h2>
			<div class="row">
				<div class="col-md-6">
					<div class="card">
						@if (count($errors) > 0)
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li> {{$error}} </li>
									@endforeach
								</ul>
							</div>
						@endif
						{!!Form::model($empleado, ['method' => 'PATCH', 'route' => ['empleado.update', $empleado -> id_empleado]])!!}
							{{Form::token()}}
							<div class="card-body">
								<h4 class="card-title">Datos de registro del empleado</h4>
								<div class="form-group row">
									<label for="txtNombre" class="col-sm-3 text-right control-label col-form-label">Nombre completo : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtNombre" value="{{$empleado -> nombre}}" placeholder="El nombre completo del empleado aquí" name="txtNombre">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtCi" class="col-sm-3 text-right control-label col-form-label">Cédula de identidad : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtCi" value="{{$empleado -> ci}}" placeholder="La cédula de identidad del empleado aquí" name="txtCi">
									</div>
								</div>
								<div class="form-group row">
									<label for="rbtSexo0" class="col-sm-3 text-right control-label col-form-label">Sexo : </label>
									<div class="col-sm-9">
									@if($empleado -> sexo == 'm')
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="rbtSexo0" name="rbtSexo" required checked value = 'm'>
											<label class="custom-control-label" for="rbtSexo0">Masculino</label>
										</div>
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="rbtSexo1" name="rbtSexo" required value = 'f'>
											<label class="custom-control-label" for="rbtSexo1">Femenino</label>
										</div>
									@else
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="rbtSexo0" name="rbtSexo" required value = 'm'>
											<label class="custom-control-label" for="rbtSexo0">Masculino</label>
										</div>
										<div class="custom-control custom-radio">
											<input type="radio" class="custom-control-input" id="rbtSexo1" name="rbtSexo" required checked value = 'f'>
											<label class="custom-control-label" for="rbtSexo1">Femenino</label>
										</div>
									@endif
									</div>
								</div>
								<div class="form-group row">
									<label for="datepicker-autoclose" class="col-sm-3 text-right control-label col-form-label">Fecha de nacimiento : </label>
									<div class="col-sm-9">
										<div class="input-group">
											<input type="text" class="form-control" id="datepicker-autoclose"  value="{{$empleado -> fecha_nacimiento}}" placeholder="yyyy/mm/dd" name="dtmFechaNacimiento">
											<div class="input-group-append">
												<span class="input-group-text"><i class="fa fa-calendar"></i></span>
											</div>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="txtTelefono" class="col-sm-3 text-right control-label col-form-label">Teléfono : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtTelefono" value="{{$empleado -> telefono}}" placeholder="Número telefónico del empleado aquí" name="txtTelefono" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtCelular" class="col-sm-3 text-right control-label col-form-label">Celular : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtCelular" value="{{$empleado -> celular}}" placeholder="Número del celular del empleado aquí" name="txtCelular" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtCorreo" class="col-sm-3 text-right control-label col-form-label" id="lblCorreo">Correo : </label>
                                    <div class="col-sm-9">
										<input type="text" class="form-control" id="txtCorreo" value="{{$empleado -> correo}}" placeholder="e-mail del empleado aquí" name="txtCorreo" onblur="ValidarCorreo(event, this)">
                                        <label for="txtCorreo" class="col-sm-3 text-right control-label col-form-label" id="msmCorreo"></label>
                                    </div>
                                </div>	
								<div class="form-group row">
									<label for="txtCelular" class="col-sm-3 text-right control-label col-form-label">Dirección : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtDireccion" value="{{$empleado -> direccion}}" placeholder="Dirección del empleado aquí" name="txtDireccion">
									</div>
								</div>
								<div class="form-group row">
									<label for="imgFoto" class="col-sm-3 text-right control-label col-form-label">Fotografía </label>
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
													<option value={{$pais -> id_pais}}> Actual : {{$pais ->nombre}}</option>
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
												<option value="{{$ciudad -> id_ciudad}}">Actual : {{$ciudad->nombre}}</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="cbxSucursal" class="col-sm-3 text-right control-label col-form-label">Sucursal : </label>
									<div class="col-sm-9">
										<div class="col-md-9">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxSucursal" name="cbxSucursal">
												<option value="{{$sucursal -> id_sucursal}}">Actual : {{$sucursal->nombre}}</option>
											</select>
										</div>
									</div>
								</div>
								<h4 class="card-title">Datos de contacto de referencia del empleado</h4>
								<div class="form-group row">
									<label for="txtPersonaReferencia" class="col-sm-3 text-right control-label col-form-label">Nombre del contacto : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtPersonaReferencia" value="{{$empleado -> persona_referencia}}" placeholder="Nombre de un contacto de referencia aquí" name="txtPersonaReferencia">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtTelefonoReferencia" class="col-sm-3 text-right control-label col-form-label">Teléfono del contacto : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtTelefonoReferencia" value="{{$empleado -> telefono_referencia}}" placeholder="Teléfono del contacto de referencia aquí" name="txtTelefonoReferencia" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)">
									</div>
								</div>
							</div>		
							<div class="border-top">
								<div class="card-body">
									<button type="submit" class="btn btn-primary">Guardar</button>
									<button type="reset" class="btn btn-danger">Cancelar</button>
								</div>
							</div>
							{!!Form::close()!!}
					</div>
				</div>
			</div>
			<!-- ============================================================== -->
			<!-- End Page Content -->
			<!-- ============================================================== -->
		</div>
		<!-- ============================================================== -->
		<!-- End Container fluid  -->
		<!-- ============================================================== -->
	  
		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
		<!-- Bootstrap tether Core JavaScript -->
		<script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
		<script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
		<!-- slimscrollbar scrollbar JavaScript -->
		<script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
		<script src="{{asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>
		<!--Wave Effects -->
		<script src="{{asset('dist/js/waves.js')}}"></script>
		<!--Menu sidebar -->
		<script src="{{asset('dist/js/sidebarmenu.js')}}"></script>
		<!--Custom JavaScript -->
		<script src="{{asset('dist/js/custom.min.js')}}"></script>
		<!-- This Page JS -->
		<script src="{{asset('assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
		<script src="{{asset('dist/js/pages/mask/mask.init.j')}}"></script>
		<script src="{{asset('assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
		<script src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
		<script src="{{asset('assets/libs/jquery-asColor/dist/jquery-asColor.min.js')}}"></script>
		<script src="{{asset('assets/libs/jquery-asGradient/dist/jquery-asGradient.js')}}"></script>
		<script src="{{asset('assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js')}}"></script>
		<script src="{{asset('assets/libs/jquery-minicolors/jquery.minicolors.min.js')}}"></script>
		<script src="{{asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
		<script src="{{asset('assets/libs/quill/dist/quill.min.js')}}"></script>
		<script src="{{asset('nihil/js/desplegable_pais_ciudad.js')}}"></script>
		<script src="{{asset('nihil/js/desplegable_ciudad_sucursal.js')}}"></script>
		<script src="{{asset('nihil/js/validadores.js')}}"></script>
		<script>
			//***********************************//
			// For select 2
			//***********************************//
			$(".select2").select2();

			/*colorpicker*/
			$('.demo').each(function() {
			//
			// Dear reader, it's actually very easy to initialize MiniColors. For example:
			//
			//  $(selector).minicolors();
			//
			// The way I've done it below is just for the demo, so don't get confused
			// by it. Also, data- attributes aren't supported at this time...they're
			// only used for this demo.
			//
			$(this).minicolors({
					control: $(this).attr('data-control') || 'hue',
					position: $(this).attr('data-position') || 'bottom left',

					change: function(value, opacity) {
						if (!value) return;
						if (opacity) value += ', ' + opacity;
						if (typeof console === 'object') {
							console.log(value);
						}
					},
					theme: 'bootstrap'
				});

			});
			/*datwpicker*/
			jQuery('.mydatepicker').datepicker();
			jQuery('#datepicker-autoclose').datepicker({
				autoclose: true,
				todayHighlight: true
			});
			var quill = new Quill('#editor', {
				theme: 'snow'
			});

		</script>
@endsection