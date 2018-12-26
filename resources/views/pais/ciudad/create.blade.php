<html>
	<head> <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}"> </head>
	<body>
		<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-create-ciudad-{{$id_pais}}">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li> {{$error}} </li>
						@endforeach
					</ul>
				</div>
			@endif
			{!!Form::open(array('class' => 'form-horizontal', 'url' => 'ciudad', 'method' => 'POST', 'autocomplete' => 'off'))!!}
			{{Form::token()}}
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"> Registrar nueva ciudad </h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
							</button>
						</div>
						<div class="modal-body">	
							<input type="hidden" id="txtIdPais" name="txtIdPais" value="{{$id_pais}}">
							<div class="form-group row">
									<label for="txtNombre" class="col-sm-3 text-right control-label col-form-label">Nombre : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtNombre" placeholder="El nombre de la ciudad aquí" name="txtNombre">
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
	<body>
</html>