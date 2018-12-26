<html>
	<head> <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}"> </head>
	<body>
		<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-moneda-{{$m -> id_moneda}}">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li> {{$error}} </li>
						@endforeach
					</ul>
				</div>
			@endif
			{!!Form::model($m, ['method' => 'PATCH', 'route' => ['moneda.update', $m -> id_moneda]])!!}
			{{Form::token()}}
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"> Editar moneda : {{$m -> nombre}} </h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
							</button>
						</div>
						<div class="modal-body">	
							<div class="form-group row">
									<label for="txtNombre" class="col-sm-3 text-right control-label col-form-label">Nombre : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtNombre" value="{{$m -> nombre}}" placeholder="El nombre de la moneda que desea registrar aquí" name="txtNombre">
									</div>
							</div>
							<div class="form-group row">
									<label for="txtCodigo" class="col-sm-3 text-right control-label col-form-label">Código : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtCodigo" value="{{$m -> codigo}}" placeholder="El código de la moneda que desea registrar aquí" name="txtCodigo">
									</div>
							</div>
							<div class="form-group row">
								<label for="cbxPais" class="col-sm-3 text-right control-label col-form-label">País : </label>
								<div class="col-sm-9">
									<div class="col-md-9">
										<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxPais" name="cbxPais">
												<option value={{$m -> id_pais}}> Actual : {{$m -> pais}}</option>
												@foreach($paises as $p)
													<option value={{$p -> id_pais}}>{{$p ->nombre}}</option>
												@endforeach
										</select>
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
	<body>
</html>