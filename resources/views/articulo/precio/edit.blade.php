<html>
	<head> <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}"> </head>
	<body>
		<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-precio-{{$p -> id_precio}}">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li> {{$error}} </li>
						@endforeach
					</ul>
				</div>
			@endif
			{!!Form::model($p, ['method' => 'PATCH', 'route' => ['precio.update', $p -> id_precio]])!!}
			{{Form::token()}}
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"> Editar lista de precios del artículo {{$p -> articulo}} de la sucursal {{$p -> sucursal}} : </h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
							</button>
						</div>
						<div class="modal-body">	
							<div class="form-group row">
								<label for="txtPrecio1" class="col-sm-3 text-right control-label col-form-label">Precio 1 : </label>
									<div class="col-sm-9">
										<div class="input-group">
											<input type="text" class="form-control" id="txtPrecio1" value="{{$p -> precio_1}}" placeholder="00.00" name="txtPrecio1" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
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
											<input type="text" class="form-control" id="txtPrecio2" value="{{$p -> precio_2}}" placeholder="00.00" name="txtPrecio2" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
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
											<input type="text" class="form-control" id="txtPrecio3" value="{{$p -> precio_3}}" placeholder="00.00" name="txtPrecio3" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
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
											<input type="text" class="form-control" id="txtPrecio4" value="{{$p -> precio_4}}" placeholder="00.00" name="txtPrecio4" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
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
											<input type="text" class="form-control" id="txtPrecio5" value="{{$p -> precio_5}}" placeholder="00.00" name="txtPrecio5" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
											<div class="input-group-append">
											<span class="input-group-text" id="basic-addon2">Bs.</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary"> Modificar </button>
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
		<script src="{{asset('nihil/js/desplegable_sucursal_empleado.js')}}"></script>
		
	<body>
</html>