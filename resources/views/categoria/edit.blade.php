<html>
	<head> <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}"> </head>
	<body>
		<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-categoria-{{$c -> id_categoria}}">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li> {{$error}} </li>
						@endforeach
					</ul>
				</div>
			@endif
			{!!Form::model($c, ['method' => 'PATCH', 'route' => ['categoria.update', $c -> id_categoria]])!!}
			{{Form::token()}}
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"> Editar categoría : {{$c -> categoria}} </h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
							</button>
						</div>
						<div class="modal-body">	
							<div class="form-group row">
									<label for="txtCategoria" class="col-sm-3 text-right control-label col-form-label">Nombre de la categoría : </label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="txtCategoria" value="{{$c -> categoria}}" placeholder="Nombre de la categoría que desea registrar aquí" name="txtCategoria">
									</div>
							</div>
							<div class="form-group row">
									<label for="txtDescripcion" class="col-sm-3 text-right control-label col-form-label">Descripción : </label>
									<div class="col-sm-9">
										<textarea rows="5" wrap="soft" class="form-control" id="txtDescripcion" placeholder="Escriba una breve descripción de la categoría aquí" name="txtDescripcion">{{$c -> descripcion}}</textarea>
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