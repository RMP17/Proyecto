<html>
	<head> <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}"> </head>
	<body>
		<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-almacen-{{$a -> id_almacen}}">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li> {{$error}} </li>
						@endforeach
					</ul>
				</div>
			@endif
			{!!Form::model($a, ['method' => 'PATCH', 'route' => ['almacen.update', $a -> id_almacen]])!!}
			{{Form::token()}}
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"> Editar almacen : {{$a -> codigo}} </h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
							</button>
						</div>
						<div class="modal-body">	
							<input type="hidden" id="txtIdSucursal" name="txtIdSucursal" value="{{$a -> id_sucursal}}">
							<div class="form-group row">
								<label for="txtCodigo" class="col-sm-3 text-right control-label col-form-label">Codigo : </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="txtCodigo" value="{{$a -> codigo}}" placeholder="El código o nombre único del almacen aquí" name="txtCodigo">
								</div>
							</div>
							<div class="form-group row">
									<label for="txtDireccion" class="col-sm-3 text-right control-label col-form-label">Direccion : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtDireccion" value="{{$a -> direccion}}" placeholder="La dirección dónde está ubicado el almacen aquí" name="txtDireccion">
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
	<body>
</html>