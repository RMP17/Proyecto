<!DOCTYPE html>
<html dir="proveedor" lang="en">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<!-- Tell the browser to be responsive to screen width -->
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<!-- Custom CSS -->
		<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/jquery-minicolors/jquery.minicolors.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/libs/quill/dist/quill.snow.css')}}">
		<link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
		<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
	</head>

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
						{!!Form::open(array('class' => 'form-horizontal', 'url' => 'proveedor', 'method' => 'POST', 'autocomplete' => 'off'))!!}
							{{Form::token()}}
							<div class="card-body">
								<h4 class="card-title">Datos de registro del proveedor</h4>
								<div class="form-group row">
									<label for="txtRazonSocial" class="col-sm-3 text-right control-label col-form-label">Razón Social (*): </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtRazonSocial" placeholder="Razón social del proveedor aquí" name="txtRazonSocial">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtNit" class="col-sm-3 text-right control-label col-form-label">NIT (*): </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtNit" placeholder="El NIT del Proveedor aquí" name="txtNit">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtTelefono" class="col-sm-3 text-right control-label col-form-label">Teléfono : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtTelefono" placeholder="Número telefónico del proveedor aquí" name="txtTelefono" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtCelular" class="col-sm-3 text-right control-label col-form-label">Celular : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtCelular" placeholder="Número del celular del proveedor aquí" name="txtCelular" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtCorreo" class="col-sm-3 text-right control-label col-form-label" id="lblCorreo">Correo : </label>
                                    <div class="col-sm-9">
										<input type="text" class="form-control" id="txtCorreo" placeholder="E-mail del proveedor aquí" name="txtCorreo" onblur="ValidarCorreo(event, this.id)">
                                        <label for="txtCorreo" class="col-sm-3 text-right control-label col-form-label" id="msmCorreo"></label>
                                    </div>
                                </div>
                                <div class="form-group row">
									<label for="txtSitioWeb" class="col-sm-3 text-right control-label col-form-label" id="lblSitioWeb">Sitio web : </label>
                                    <div class="col-sm-9">
										<input type="text" class="form-control" id="txtSitioWeb" placeholder="Sitio web del proveedor aquí" name="txtSitioWeb" onblur="ValidarSitioWeb(event, this.id)">
                                        <label for="txtSitioWeb" class="col-sm-3 text-right control-label col-form-label" id="msmSitioWeb"></label>
                                    </div>
                                </div>	
								<div class="form-group row">
									<label for="txtDireccion" class="col-sm-3 text-right control-label col-form-label">Dirección : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtDireccion" placeholder="Dirección del proveedor aquí" name="txtDireccion">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtRubro" class="col-sm-3 text-right control-label col-form-label">Rubro : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtRubro" placeholder="El rubro del proveedor aquí" name="txtRubro">
									</div>
								</div>
								<div class="form-group row">
									<label for="cbxPais" class="col-sm-3 text-right control-label col-form-label">País : </label>
									<div class="col-sm-9">
										<div class="col-md-9">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxPais" name="cbxPais">
												<option>País...</option>
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
	</body>

</html>