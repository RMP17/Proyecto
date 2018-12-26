<html>
	<head> <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}"> </head>
	<body>
		<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-close-caja_chica-{{$c -> id_caja_chica}}">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li> {{$error}} </li>
						@endforeach
					</ul>
				</div>
			@endif
			{{Form::Open(array('action' => array ('CajaChicaControlador@destroy', $c -> id_caja_chica), 'method' => 'DELETE'))}}
			{{Form::token()}}
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"> Cerrar caja chica : </h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
							</button>
						</div>
						<div class="modal-body">	
							<div class="form-group row">
								<label for="txtMontoApertura" class="col-sm-3 text-right control-label col-form-label">Monto de apertura : </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="txtMontoApertura" value="{{$c -> monto_apertura}}" placeholder="00.00" name="txtMontoApertura" disabled>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtMontoEstado" class="col-sm-3 text-right control-label col-form-label">Monto de cierre : </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="txtMontoEstado" value="{{$c -> monto_estado}}" placeholder="00.00" name="txtMontoEstado" disabled>
								</div>
							</div>
							<div class="form-group row">
								<label for="cbxSucursal" class="col-sm-3 text-right control-label col-form-label">Sucursal : </label>
								<div class="col-sm-9">
									<div class="col-md-9">
										<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxSucursal" name="cbxSucursal" disabled>
												<option value={{$c -> id_sucursal}}> Actual : {{$c -> sucursal}}</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="cbxEmpleado" class="col-sm-3 text-right control-label col-form-label">Empleado a cargo : </label>
								<div class="col-sm-9">
									<div class="col-md-9">
										<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxEmpleado" name="cbxEmpleado" disabled>
											<option value="{{$c -> id_empleado}}">Actual : {{$c -> empleado}}</option>
										</select>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtMontoDeclarado" class="col-sm-3 text-right control-label col-form-label">Monto declarado : </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="txtMontoDeclarado" placeholder="00.00" name="txtMontoDeclarado" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)" onchange="RestarMontos(event, this.id)">
								</div>
							</div>
							<div class="form-group row">
								<label for="txtDiferencia" class="col-sm-3 text-right control-label col-form-label">Diferencia : </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="txtDiferencia" placeholder="00.00" name="txtDiferencia" disabled>
								</div>
							</div>
							<div class="form-group row">
								<label for="txtObservaciones" class="col-sm-3 text-right control-label col-form-label">Observaciones : </label>
								<div class="col-sm-8">
									<textarea rows="5" wrap="soft" class="form-control" id="txtObservaciones" placeholder="Escriba las observaciones de cierre de caja chica" name="txtObservaciones"></textarea>
								</div>
							</div>
						</div>	
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary"> Confirmar </button>
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
		<script src="{{asset('nihil/js/validadores.js')}}"></script>
	<body>
</html>