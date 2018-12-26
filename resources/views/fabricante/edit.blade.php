<html>
	<head> <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}"> </head>
	<body>
		<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-fabricante-{{$f -> id_fabricante}}">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li> {{$error}} </li>
						@endforeach
					</ul>
				</div>
			@endif
			{!!Form::model($f, ['method' => 'PATCH', 'route' => ['fabricante.update', $f -> id_fabricante]])!!}
			{{Form::token()}}
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"> Editar fabricante : {{$f -> nombre}} </h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
							</button>
						</div>
						<div class="modal-body">	
							<div class="form-group row">
								<label for="txtNombre" class="col-sm-3 text-right control-label col-form-label">Nombre : </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="txtNombre" value="{{$f -> nombre}}" placeholder="Nombre del fabricante que desea registrar" name="txtNombre">
								</div>
							</div>
							<div class="form-group row">
								<label for="txtContacto" class="col-sm-3 text-right control-label col-form-label">Contacto : </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="txtContacto" value="{{$f -> contacto}}" placeholder="Número de contacto del fabricante aquí" name="txtContacto" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)">
								</div>
							</div>
							<div class="form-group row">
								<label for="txtSitioWeb" class="col-sm-3 text-right control-label col-form-label" id="lblSitioWeb">Sitio web : </label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="txtSitioWeb" placeholder="Sitio web del fabricante aquí" name="txtSitioWeb" onblur="ValidarSitioWeb(event, this.id)">
									<label for="txtSitioWeb" class="col-sm-3 text-right control-label col-form-label" id="msmSitioWeb"></label>
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
		<script src="{{asset('nihil/js/validadores.js')}}"></script>
		
	<body>
</html>