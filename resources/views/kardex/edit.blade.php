@extends('maquetas.admin')
@section('page_wrapper')
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
			<h2> </h2>
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
						{!!Form::model($kardex, ['method' => 'PATCH', 'route' => ['kardex.update', $kardex -> id_kardex]])!!}
							{{Form::token()}}
							<div class="card-body">
								<h4 class="card-title">Datos de registro Kardex</h4>
                    			<div class="form-group row">
									<label for="cbxEmpleado" class="col-sm-3 text-right control-label col-form-label">Empleado : </label>
									<div class="col-sm-9">
										<div class="col-md-9">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxEmpleado" name="cbxEmpleado" value="$kardex->id_empleado">
                                            @foreach($empleados as $e)
                                             @if($e->id_empleado==$kardex->id_empleado) 
                                            <option value="{{$e->id_empleado}}" selected>{{$e->nombre}}</option>
                                            @else
                                            <option value="{{$e->id_empleado}}">{{$e->nombre}}</option>
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
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxCargo" name="cbxCargo" value="$kardex->id_cargo">
                                            @foreach($cargos as $c)
                                             @if($c->id_cargo==$kardex->id_cargo) 
                                            <option value="{{$c->id_cargo}}" selected>{{$c->nombre}}</option>
                                            @else
                                            <option value="{{$c->id_cargo}}">{{$c->nombre}}</option>
                                            @endif
                                            @endforeach
                                        </select>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="cbxTipo_empleado" class="col-sm-3 text-right control-label col-form-label">Tipo empleado : </label>
									<div class="col-sm-9">
										<div class="col-md-9">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" d="cbxTipo_empleado" name="cbxTipo_empleado" value="$kardex->id_tipo_empleado" >
                                            @foreach($tipo_empleado as $t)
                                             @if($t->id_tipo_empleado==$kardex->id_tipo_empleado) 
                                            <option value="{{$t->id_tipo_empleado}}" selected>{{$t->tipo}}</option>
                                            @else
                                            <option value="{{$t->id_tipo_empleado}}">{{$t->tipo}}</option>
                                            @endif
                                            @endforeach
                                        </select>
										</div>
									</div>
								</div>
						
								<div class="form-group row">
									<label for="datepicker-autoclose" class="col-sm-3 text-right control-label col-form-label">Fecha de inicio: </label>
									<div class="col-sm-9">
										<div class="input-group">
											<input type="text" class="form-control" id="datepicker-autoclose" placeholder="yyyy/mm/dd" name="dtmFecha_inicio" value="{{$kardex->fecah_inicio}}">
											<div class="input-group-append">
												<span class="input-group-text"><i class="fa fa-calendar"></i></span>
											</div>
										</div>
									</div>
								</div>
									
								<h4 class="card-title">Salario</h4>
								<div class="form-group row">
									<label for="txtPersonaReferencia" class="col-sm-3 text-right control-label col-form-label">Monto : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtMonto" placeholder="" name="txtMonto" value="{{$salario->monto}}">
									</div>
								</div>
								<div class="form-group row">
									<label for="cbxMoneda" class="col-sm-3 text-right control-label col-form-label">Moneda : </label>
									<div class="col-sm-9">
										<div class="col-md-9">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxMoneda" name="cbxMoneda" value="$salario->id_moneda">
                                            @foreach($monedas as $m)
                                             @if($m->id_moneda==$salario->id_moneda) 
                                            <option value="{{$m->id_moneda}}" selected>{{$m->nombre}}</option>
                                            @else
                                            <option value="{{$m->id_moneda}}">{{$m->nombre}}</option>
                                            @endif
                                            @endforeach
                                        </select>
										</div>
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
		</div>
		
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