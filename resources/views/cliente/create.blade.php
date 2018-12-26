
		<div class="container-fluid">
			<!-- ============================================================== -->
			<!-- Start Page Content -->
			<!-- ============================================================== -->
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
						{!!Form::open(array('class' => 'form-horizontal', 'url' => 'cliente', 'method' => 'POST', 'autocomplete' => 'off'))!!}
							{{Form::token()}}
							<div class="card-body">
								<h4 class="card-title">Datos de registro del cliente</h4>
								<div class="form-group row">
									<label for="txtRazonSocial" class="col-sm-3 text-right control-label col-form-label">Razón social : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtRazonSocial" placeholder="La razón social del cliente va aquí" name="txtRazonSocial">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtNit" class="col-sm-3 text-right control-label col-form-label">Cédula de identidad o NIT : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtNit" placeholder="La cédula de identidad del empleado aquí" name="txtNit">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtActividad" class="col-sm-3 text-right control-label col-form-label">Actividad : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtActividad" placeholder="La cédula de identidad del empleado aquí" name="txtActividad">
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
									<label for="cbxPais" class="col-sm-3 text-right control-label col-form-label">País : </label>
									<div class="col-sm-9">
										<div class="col-md-9">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxPais" name="cbxPais">
												<option>País...</option>
												<tr v-for="(pais, create) in paises">

												<th scope="row">@{{create}}</th>
												<td>@{{ categoria.nombre }}</td>

											</select>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="cbxCiudad" class="col-sm-3 text-right control-label col-form-label">Ciudad : </label>
									<div class="col-sm-9">
										<div class="col-md-9">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxCiudad" name="cbxCiudad">
												<option>Ciudad...</option>
												
											</select>
										</div>
									</div>
								</div>
							</div>		
							<div class="border-top">
								<div class="card-body">
									<button type="submit" class="btn btn-primary">Registrar</button>
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
