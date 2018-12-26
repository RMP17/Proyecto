{{--
<div class="row">
	<div class="col-md-6">
		<div class="card">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li> {{$error}} </li>
						@endforeach
					</ul>
				</div>
			@endif
						
			{!!Form::model($articulos, ['method' => 'PATCH'])!!}
				{{Form::token()}}
				<!-- <input type="text" id="press"> -->
				<span id="press"></span>
				<div class="card-body">
					<h4 class="card-title">Datos del artículo</h4>
					<div class="form-group row">
						<label for="txtNombre" class="col-sm-3 text-right control-label col-form-label">Artículo : </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="txtNombre" value="" placeholder="El nombre del artículo va aquí" name="txtNombre">
						</div>
					</div>
					<div class="form-group row">
						<label for="txtCodigo" class="col-sm-3 text-right control-label col-form-label">Código : </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="txtCodigo" value="" placeholder="El código del artículo que lo identifique va aquí" name="txtCodigo">
						</div>
					</div>
					<div class="form-group row">
						<label for="txtCodigoBarra" class="col-sm-3 text-right control-label col-form-label">Código de Barra : </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="txtCodigoBarra" value="" placeholder="La serie del código de barras va aquí" name="txtCodigoBarra">
						</div>
					</div>
					<div class="form-group row">
						<label for="txtCodigoBarra" class="col-sm-3 text-right control-label col-form-label">Características : </label>
						<div class="col-sm-9">
							<textarea rows="5" wrap="soft" class="form-control" id="txtCaracteristicas" placeholder="Escriba algunas características relevantes del artículo" name="txtCaracteristicas"></textarea>
						</div>
					</div>
				{!!Form::close()!!}
		</div>
	</div>
</div>

--}}
