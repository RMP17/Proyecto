@extends('maquetas.admin')
@section('page_wrapper')
<div class="container-fluid">
	<!-- ============================================================== -->
	<!-- Start Page Content -->
	<!-- ============================================================== -->
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
				{!!Form::open(array('class' => 'form-horizontal', 'url' => 'kardex', 'method' => 'POST', 'autocomplete' => 'off'))!!}
				{{Form::token()}}
				<div class="card-body">
					<h4 class="card-title">Datos de registro Kardex</h4>
					<div class="form-group row">
						<label for="cbxEmpleado" class="col-sm-3 text-right control-label col-form-label">Empleado : </label>
						<div class="col-sm-9">
							<div class="col-md-9">
								<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxEmpleado" name="cbxEmpleado">
									<option>Empleado...</option>
									@foreach($empleados as $e)
										<option value={{$e -> id_empleado}}>{{$e ->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="cbxCargo" class="col-sm-3 text-right control-label col-form-label">Cargo : </label>
						<div class="col-sm-9">
							<div class="col-md-9">
								<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxCargo" name="cbxCargo">
									<option>Cargo...</option>
									@foreach($cargos as $c)
										<option value={{$c -> id_cargo}}>{{$c ->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="form-group row">
						<label for="cbxTipo_empleado" class="col-sm-3 text-right control-label col-form-label">Tipo empleado : </label>
						<div class="col-sm-9">
							<div class="col-md-9">
								<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxTipo_empleado" name="cbxTipo_empleado">
									<option>Empleado...</option>
									@foreach($tipo_empleado as $t)
										<option value={{$t -> id_tipo_empleado}}>{{$t ->tipo}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

					<div class="form-group row">
						<label for="datepicker-autoclose" class="col-sm-3 text-right control-label col-form-label">Fecha de inicio: </label>
						<div class="col-sm-9">
							<div class="input-group">
								<input type="text" class="form-control" id="datepicker-autoclose" placeholder="yyyy/mm/dd" name="dtmFecha_inicio">
								<div class="input-group-append">
									<span class="input-group-text"><i class="fa fa-calendar"></i></span>
								</div>
							</div>
						</div>
					</div>

					<h4 class="card-title">Salario</h4>
					<div class="form-group row">
						<label for="txtPersonaReferencia" class="col-sm-3 text-right control-label col-form-label">Monto : </label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="txtMonto" placeholder="" name="txtMonto">
						</div>
					</div>
					<div class="form-group row">
						<label for="cbxMoneda" class="col-sm-3 text-right control-label col-form-label">Moneda : </label>
						<div class="col-sm-9">
							<div class="col-md-9">
								<select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxMoneda" name="cbxMoneda">
									<option>Moneda...</option>
									@foreach($monedas as $m)
										<option value={{$m -> id_moneda}}>{{$m ->nombre}}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>

				</div>
				<div class="border-top">
					<div class="card-body">
						<button type="submit" class="btn btn-primary">Registrar</button>
						<button type="reset" class="btn btn-danger">Cancelar</button>
					</div>
				</div>
				{!!Form::close()!!}
			</div>
		</div>
	</div>
	<!-- ============================================================== -->
	<!-- End Page Content -->
	<!-- ============================================================== -->
</div>
	@endsection