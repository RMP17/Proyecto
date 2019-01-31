@extends('maquetas.admin')
@section('page_wrapper')
	<div id="app-cortes">
		<div class="container-fluid">
			<div class="row justify-content-md-center">

				<div class="col-xs-12 col-sm-12 col-md-8">
					<div class="card">
						<form class="form-horizontal">
								<div class="card-body">
										<h4 class="card-title">Información de Placa</h4>
										<div class="form-group row">
												<label for="fname" class="col-sm-3 text-right control-label col-form-label">Ancho [cm]</label>
												<div class="col-sm-9">
														<input type="number" class="form-control" id="fname" placeholder="Ingrese ancho">
												</div>
										</div>
										<div class="form-group row">
												<label for="lname" class="col-sm-3 text-right control-label col-form-label">Alto [cm]</label>
												<div class="col-sm-9">
														<input type="number" class="form-control" id="lname" placeholder="Ingrese Altura">
												</div>
										</div>
										<div class="border-top">
												<div class="card-body">
													<h4 class="card-title"> > Ingrese Cortes</h4>
													<div class="form-group row">
														<div class="col-sm-3">
																<input type="number" class="form-control" id="ancho1" placeholder="Ancho">																
														</div>
														<label class="col-sm-1 text-right control-label col-form-label">X</label>
														<div class="col-sm-3">
																<input type="number" class="form-control" id="alto1" placeholder="Alto">
														</div>
														<label class="col-sm-1 text-right control-label col-form-label">X</label>
														<div class="col-sm-3">
																<input type="number" class="form-control" id="cant1" placeholder="Cantidad">
														</div>
														<div class="col-sm-1">
																<input type="button" class="btn btn-primary" id="add" value="+">
														</div>
													</div>
												</div>
										</div>
								</div>
								<div class="border-top">
										<div class="card-body">
												<button type="button" class="btn btn-primary">Generar Cortes</button>
										</div>
								</div>
						</form>
					</div>
				</div>

			</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script src="{{asset('js/cortes.js')}}"></script>
@endsection
