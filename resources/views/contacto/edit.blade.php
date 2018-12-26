extends('maquetas.admin')
@section('page_wrapper')
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
						{!!Form::model($contacto,['method'=>'PATCH','route'=>['contacto.update',$contacto->id_contacto]])!!}
						{{Form::token()}}
							<div class="card-body">
								<h4 class="card-title">Modificar contacto</h4>
								<div class="form-group row">
									<label for="txtNombre" class="col-sm-3 text-right control-label col-form-label">Nombre (*): </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtNombre" placeholder="Nombre del contacto aquí" name="txtNombre" value="{{$contacto->nombre}}">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtTelefono" class="col-sm-3 text-right control-label col-form-label">Teléfono : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtTelefono" placeholder="Número telefónico del contacto aquí" name="txtTelefono" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)" value="{{$contacto->telefono}}">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtInterno" class="col-sm-3 text-right control-label col-form-label">Teléfono interno : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtInterno" placeholder="El número de contacto interno aquí" name="txtInterno" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)" value="{{$contacto->interno}}">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtCelular" class="col-sm-3 text-right control-label col-form-label">Celular : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtCelular" placeholder="Número del celular del contacto aquí" name="txtCelular" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)" value="{{$contacto->celular}}">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtCorreo" class="col-sm-3 text-right control-label col-form-label" id="lblCorreo">Correo : </label>
                                    <div class="col-sm-9">
										<input type="text" class="form-control" value="{{$contacto->correo}}" id="txtCorreo" placeholder="e-mail del contacto aquí" name="txtCorreo" onblur="ValidarCorreo(event, 'txtCorreo')">
                                        <label for="txtCorreo" class="col-sm-3 text-right control-label col-form-label" id="msmCorreo"></label>
                                    </div>
                                </div>
								<div class="form-group row">
									<label for="cbxProveedor" class="col-sm-3 text-right control-label col-form-label">Proveedor : </label>
									<div class="col-sm-9">
										<div class="col-md-9">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxProveedor" name="cbxProveedor">
												@foreach($proveedores as $p)
	                                             @if($p->id_proveedor==$contacto->id_proveedor) 
												<option value="{{$p->id_proveedor}}" selected>{{$p->razon_social}}</option>
	                                            @else
	                                            <option value="{{$p->id_proveedor}}">{{$p->razon_social}}</option>
	                                            @endif
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="cbxCargo" class="col-sm-3 text-right control-label col-form-label">Cargo : </label>
									<div class="col-sm-9">
										<div class="col-md-9">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxCargo" name="cbxCargo">
												@foreach($cargos as $c)
	                                             @if($c->id_cargo==$contacto->id_cargo) 
												<option value="{{$c->id_cargo}}" selected>{{$c->nombre}}</option>
	                                            @else
	                                            <option value="{{$c->id_cargo}}">{{$c->nombre}}</option>
	                                            @endif
												@endforeach
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
	@endsection