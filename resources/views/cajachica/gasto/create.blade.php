<html>
	<head> <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}"> </head>
	<body>
		<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-create-gasto">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li> {{$error}} </li>
						@endforeach
					</ul>
				</div>
			@endif
			{!!Form::open(array('class' => 'form-horizontal', 'url' => 'gasto', 'method' => 'POST', 'autocomplete' => 'off'))!!}
			{{Form::token()}}
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"> Añadir gasto </h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
							</button>
						</div>
						<div class="modal-body">	
							<div class="form-group row">
                                <label for="txtMonto" class="col-sm-3 text-right control-label col-form-label">Monto: </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="txtMonto" placeholder="00.00" name="txtMonto" onkeypress="return ValidarDecimalTecleado(event, this.id)" onblur="ValidarDecimalPegado(event, this.id)">
                                    </div>
                                </div>
                            <div >
							<div class="form-group row">
								<label for="txtDescripcion" class="col-sm-3 text-right control-label col-form-label">Descripcion : </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="txtDescripcion" placeholder="" name="txtDescripcion">
								</div>
							</div>
                            <input type="hidden" class="form-control" id="txtCajaChica" placeholder="" name="txtCajaChica" value="{{$id_caja_chica}}">
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary" onclick="return confirm('¿Está seguro de registrar el gasto?. (Los cambios son definitivos)');"> Añadir </button>
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