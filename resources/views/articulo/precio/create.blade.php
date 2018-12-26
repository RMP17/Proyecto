<html>
	<head> <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}"> </head>
	<body>
		<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-create-precio">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li> {{$error}} </li>
						@endforeach
					</ul>
				</div>
			@endif
			{!!Form::open(array('class' => 'form-horizontal', 'url' => 'precio', 'method' => 'POST', 'autocomplete' => 'off'))!!}
			{{Form::token()}}
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"> Registrar nueva lista de precios </h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
							</button>
						</div>
						<div class="form-group row">
							<label for="cbxSucursal" class="col-sm-3 text-right control-label col-form-label">Sucursal : </label>
							<div class="col-sm-9">
								<div class="col-md-9">
									<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxSucursal" name="cbxSucursal">
										<option>Sucursal...</option>
										@foreach($sucursales as $s)
											<option value={{$s -> id_sucursal}}>{{$s ->nombre}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="cbxArticulo" class="col-sm-3 text-right control-label col-form-label">Artículos : </label>
							<div class="col-sm-9">
								<div class="col-md-9">
									<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxArticulo" name="cbxArticulo">
										<option>Artículo...</option>
										@foreach($articulos as $a)
											<option value={{$a -> id_articulo}}>{{$a ->nombre}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="modal-body">	
							<div class="form-group row">
								<label for="txtPrecio1" class="col-sm-3 text-right control-label col-form-label">Precio 1 : </label>
									<div class="col-sm-9">
										<div class="input-group">
											<input type="text" class="form-control" id="txtPrecio1" placeholder="00.00" name="txtPrecio1" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
											<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">Bs.</span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtPrecio2" class="col-sm-3 text-right control-label col-form-label">Precio 2 : </label>
									<div class="col-sm-9">
										<div class="input-group">
											<input type="text" class="form-control" id="txtPrecio2" placeholder="00.00" name="txtPrecio2" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
											<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">Bs.</span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtPrecio3" class="col-sm-3 text-right control-label col-form-label">Precio 3 : </label>
									<div class="col-sm-9">
										<div class="input-group">
											<input type="text" class="form-control" id="txtPrecio3" placeholder="00.00" name="txtPrecio3" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
											<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">Bs.</span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtPrecio4" class="col-sm-3 text-right control-label col-form-label">Precio 4 : </label>
									<div class="col-sm-9">
										<div class="input-group">
											<input type="text" class="form-control" id="txtPrecio4" placeholder="00.00" name="txtPrecio4" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
											<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">Bs.</span>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtPrecio5" class="col-sm-3 text-right control-label col-form-label">Precio 5 : </label>
									<div class="col-sm-9">
										<div class="input-group">
											<input type="text" class="form-control" id="txtPrecio5" placeholder="00.00" name="txtPrecio5" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
											<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">Bs.</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary"> Crear </button>
							<button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar </button>
						</div>		
					</div>
				</div>
			{{Form::Close()}}
		<div>
		
		<!-- ============================================================== -->
		<!-- All Jquery -->
		<!-- ============================================================== -->
		<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
		<script src="{{asset('nihil/js/validadores.js')}}"></script>
		
	<body>
</html>