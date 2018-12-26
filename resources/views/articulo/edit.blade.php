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
			<h2> Datos del artículo : {{$articulo -> nombre}} </h2>
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
						{!!Form::model($articulo, ['method' => 'PATCH', 'route' => ['articulo.update', $articulo -> id_articulo]])!!}
							{{Form::token()}}
							<div class="card-body">
								<h4 class="card-title">Datos de registro del artículo</h4>
								<div class="form-group row">
									<label for="txtNombre" class="col-sm-3 text-right control-label col-form-label">Artículo : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtNombre" value="{{$articulo -> nombre}}" placeholder="El nombre del artículo va aquí" name="txtNombre">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtCodigo" class="col-sm-3 text-right control-label col-form-label">Código : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtCodigo" value="{{$articulo -> codigo}}" placeholder="El código del artículo que lo identifique va aquí" name="txtCodigo">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtCodigoBarra" class="col-sm-3 text-right control-label col-form-label">Código de Barra : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtCodigoBarra" value="{{$articulo -> codigo_barra}}" placeholder="La serie del código de barras va aquí" name="txtCodigoBarra">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtCaracteristicas" class="col-sm-3 text-right control-label col-form-label">Características : </label>
									<div class="col-sm-9">
										<textarea rows="5" wrap="soft" class="form-control" id="txtCaracteristicas" placeholder="Escriba algunas características relevantes del artículo" name="txtCaracteristicas">{{$articulo -> caracteristicas}}</textarea>
									</div>
								</div>
								<div class="form-group row">
									<label for="imgImagen" class="col-sm-3 text-right control-label col-form-label">Imagen : </label>
									<div class="col-sm-9">
										<input type="file" class="custom-file-input" id="imgImagen" accept="image/jpeg">
										<label class="custom-file-label" for="imgImagen">Carga una imagen del artículo en formato .jpeg aquí</label>
										<div class="invalid-feedback">Archivo inválido</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="cbxCategoria" class="col-sm-3 text-right control-label col-form-label">Categoría : </label>
									<div class="col-sm-9">
										<div class="col-md-9">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxCategoria" name="cbxCategoria">
												<option value={{$categoria -> id_categoria}}> Actual : {{$categoria ->categoria}}</option>
												@foreach($categorias as $c)
													<option value={{$c -> id_categoria}}>{{$c ->categoria}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="cbxSubcategoria" class="col-sm-3 text-right control-label col-form-label">Subcategoria : </label>
									<div class="col-sm-9">
										<div class="col-md-9">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxSubcategoria" name="cbxSubcategoria">
												<option value="{{$articulo -> id_subcategoria}}">Actual : {{$subcategoria}}</option>
											</select>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="cbxFabricante" class="col-sm-3 text-right control-label col-form-label">Fabricante : </label>
									<div class="col-sm-9">
										<div class="col-md-9">
											<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxFabricante" name="cbxFabricante">
												<option value="{{$articulo -> id_fabricante}}">Actual : {{$fabricante}}</option>
												@foreach($fabricantes as $f)
													<option value={{$f -> id_fabricante}}>{{$f ->nombre}}</option>
												@endforeach
											</select>
										</div>
									</div>
								</div>
								<div class="form-group row">
									<label for="rbtDivisible" class="col-sm-3 text-right control-label col-form-label">Divisible : </label>
									<div class="col-sm-9">
										@if($articulo -> divisible == 0)
											<div class="custom-control custom-radio">
												<input type="radio" class="custom-control-input" id="rbtDivisible0" name="rbtDivisible" required value = 1>
												<label class="custom-control-label" for="rbtDivisible0">Si</label>
											</div>
											<div class="custom-control custom-radio">
												<input type="radio" class="custom-control-input" id="rbtDivisible1" name="rbtDivisible" required checked value = 0>
												<label class="custom-control-label" for="rbtDivisible1">No</label>
											</div>
										@else
											<div class="custom-control custom-radio">
												<input type="radio" class="custom-control-input" id="rbtDivisible0" name="rbtDivisible" required checked value = 1>
												<label class="custom-control-label" for="rbtDivisible0">Si</label>
											</div>
											<div class="custom-control custom-radio">
												<input type="radio" class="custom-control-input" id="rbtDivisible1" name="rbtDivisible" required value = 0>
												<label class="custom-control-label" for="rbtDivisible1">No</label>
											</div>
										@endif
									</div>
								</div>
								<div class="form-group row">
									<label for="rbtDimensionable" class="col-sm-3 text-right control-label col-form-label">¿Quiere guardar sus dimensiones? : </label>
									<div class="col-sm-9">
										@if($dimensiones == null)
											<div class="custom-control custom-radio">
												<input type="radio" class="custom-control-input" id="rbtDimensionable0" name="rbtDimensionable" required value = 1 onchange="habilitar_dimensiones(1)">
												<label class="custom-control-label" for="rbtDimensionable0">Si</label>
											</div>
											<div class="custom-control custom-radio">
												<input type="radio" class="custom-control-input" id="rbtDimensionable1" name="rbtDimensionable" required checked value = 0 onchange="habilitar_dimensiones(0)">
												<label class="custom-control-label" for="rbtDimensionable1">No</label>
											</div>
										@else
											<div class="custom-control custom-radio">
												<input type="radio" class="custom-control-input" id="rbtDimensionable0" name="rbtDimensionable" required checked value = 1 onchange="habilitar_dimensiones(1)">
												<label class="custom-control-label" for="rbtDimensionable0">Si</label>
											</div>
											<div class="custom-control custom-radio">
												<input type="radio" class="custom-control-input" id="rbtDimensionable1" name="rbtDimensionable" required value = 0 onchange="habilitar_dimensiones(0)">
												<label class="custom-control-label" for="rbtDimensionable1">No</label>
											</div>
										@endif
									</div>
								</div>			
								<h4 class="card-title">Dimensiones del artículo (Unidades en centímetros)</h4>
								@if($dimensiones == null)
									<div class="form-group row">
										<label for="txtLargo" class="col-sm-3 text-right control-label col-form-label">Largo : </label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="txtLargo" placeholder="00.00" name="txtLargo" disabled onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
										</div>
									</div>
									<div class="form-group row">
										<label for="txtAncho" class="col-sm-3 text-right control-label col-form-label">Ancho : </label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="txtAncho" placeholder="00.00" name="txtAncho" disabled disabled onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
										</div>
									</div>
									<div class="form-group row">
										<label for="txtEspesor" class="col-sm-3 text-right control-label col-form-label">Espesor : </label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="txtEspesor" placeholder="00.00" name="txtEspesor" disabled disabled onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
										</div>
									</div>
									<div class="form-group row">
										<label for="txtVolumen" class="col-sm-3 text-right control-label col-form-label">Volumen : </label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="txtVolumen" placeholder="00.00" name="txtVolumen" disabled disabled onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
										</div>
									</div>
								@else
									<div class="form-group row">
										<label for="txtLargo" class="col-sm-3 text-right control-label col-form-label">Largo : </label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="txtLargo" placeholder="00.00" name="txtLargo" disabled value="{{$dimensiones->largo}}" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
										</div>
									</div>
									<div class="form-group row">
										<label for="txtAncho" class="col-sm-3 text-right control-label col-form-label">Ancho : </label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="txtAncho" placeholder="00.00" name="txtAncho" disabled value="{{$dimensiones->ancho}}" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
										</div>
									</div>
									<div class="form-group row">
										<label for="txtEspesor" class="col-sm-3 text-right control-label col-form-label">Espesor : </label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="txtEspesor" placeholder="00.00" name="txtEspesor" disabled value="{{$dimensiones->espesor}}" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
										</div>
									</div>
									<div class="form-group row">
										<label for="txtVolumen" class="col-sm-3 text-right control-label col-form-label">Volumen : </label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="txtVolumen" placeholder="00.00" name="txtVolumen" disabled value="{{$dimensiones->volumen}}" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
										</div>
									</div>
								@endif
								<h4 class="card-title">Precio de compra y venta de producción del artículo (Bs.)</h4>
								<div class="form-group row">
									<label for="txtPrecioCompra" class="col-sm-3 text-right control-label col-form-label">Precio de compra : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtPrecioCompra" placeholder="00.00" name="txtPrecioCompra" value="{{$articulo->precio_compra}}" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
									</div>
								</div>
								<div class="form-group row">
									<label for="txtPrecioProduccion" class="col-sm-3 text-right control-label col-form-label">Precio de venta (producción) : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtPrecioProduccion" placeholder="00.00" name="txtPrecioProduccion" value="{{$articulo->precio_produccion}}" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
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
		<script src="{{asset('nihil/js/desplegable.js')}}"></script>
		<script src="{{asset('nihil/js/validadores.js')}}"></script>
		<script src="{{asset('nihil/js/habilitar_dimensiones.js')}}"></script>
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