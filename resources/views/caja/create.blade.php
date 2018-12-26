<html>
	<head> <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}"> </head>
	<body>
		<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-create-caja">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li> {{$error}} </li>
						@endforeach
					</ul>
				</div>
			@endif
			{!!Form::open(array('class' => 'form-horizontal', 'url' => 'caja', 'method' => 'POST', 'autocomplete' => 'off'))!!}
			{{Form::token()}}
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"> Registrar nueva caja </h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
							</button>
						</div>
						<div class="modal-body">	
							<div class="form-group row">
									<label for="txtNombre" class="col-sm-3 text-right control-label col-form-label">Nueva caja : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtNombre" placeholder="Nombre de la caja que desea registrar" name="txtNombre">
									</div>
							</div>
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
							<label for="cbxEmpleado" class="col-sm-3 text-right control-label col-form-label">Empleado a cargo : </label>
							<div class="col-sm-9">
								<div class="col-md-9">
									<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxEmpleado" name="cbxEmpleado">
										<option>Empleado...</option>
									</select>
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
		<script src="{{asset('nihil/js/desplegable_sucursal_empleado.js')}}"></script>
		
	<body>
</html>