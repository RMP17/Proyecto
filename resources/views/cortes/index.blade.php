@extends('maquetas.admin')
@section('page_wrapper')
	<div id="app-cortes">
		<div class="container-fluid">
			<div class="row justify-content-md-center">

				<div class="col-xs-12 col-sm-12 col-md-8">
					<div class="card">
						<form class="form-horizontal" v-on:submit="runCut($event)">
								<div class="card-body">
										<h4 class="card-title">Información de Placa</h4>
										<div class="form-group row">
												<label for="cutWidth" class="col-sm-3 text-right control-label col-form-label">Ancho [cm]</label>
												<div class="col-sm-9">
														<input type="number" step=".01" min="0" class="form-control" id="cutWidth" placeholder="Ingrese ancho" v-model="size.width" required="required">
												</div>
										</div>
										<div class="form-group row">
												<label for="cutHeight" class="col-sm-3 text-right control-label col-form-label">Alto [cm]</label>
												<div class="col-sm-9">
														<input type="number" step=".01" min="0" class="form-control" id="cutHeight" placeholder="Ingrese Altura" v-model="size.height" required="required">
												</div>
										</div>

										<div class="border-top">
												<div class="card-body">
													<h4 class="card-title">Ingrese Zoom <strong></strong></h4>
													<h2>Zoom x@{{ config.scale }}</h2>
													<div class="col-sm-12">
															<input type="range" step="1" min="1" max="5" v-model="config.scale" class="form-control" placeholder="Ancho" required="required">
													</div>
										</div>

										<div class="border-top">
												<div class="card-body">
													<h4 class="card-title">Ingrese Cortes <strong>[cm]</strong></h4>
													<div class="form-group row" v-for="(corte, index) in cortes" v-bind:id="index">
														<div class="col-sm-3">
																<input type="number" step=".01" min="0" v-on:input="changeWidth($event,index)" :value="corte.width" class="form-control" placeholder="Ancho" required="required">
														</div>
														<label class="col-sm-1 text-right control-label col-form-label">X</label>
														<div class="col-sm-3">
																<input type="number" step=".01" min="0" v-on:input="changeHeight($event,index)" :value="corte.height" class="form-control" placeholder="Alto" required="required">
														</div>
														<label class="col-sm-1 text-right control-label col-form-label">X</label>
														<div class="col-sm-3">
																<input type="number" step=".01" min="0" v-on:input="changeCant($event,index)" :value="corte.cant" class="form-control" placeholder="Cantidad" required="required">
														</div>
														<div class="col-sm-1">
																<input type="button" class="btn btn-danger" value="x" @click="removeCut(index)">
														</div>
													</div>
													<button type="button" class="btn btn-info" @click="addCut">(+) Agregar</button>
												</div>
										</div>
								</div>
								<div class="border-top">
										<div class="card-body">
												<button type="submit" class="btn btn-primary">Generar Cortes</button>
										</div>
								</div>
						</form>
					</div>

					<div class="card-body" style="display:none" id="info">
						<h4 class="card-title">Porcentaje utilizado de la placa</h4>
						<div id="ratio"></div>
						<div id="notif"></div>
					</div>
				</div>

			</div>
		</div>
		<div class="row justify-content-md-center">
				<div class="col-xs-12 col-sm-12 col-md-8">
					<canvas id="canvas" style="display:none">
					</canvas>
				</div>
		</div>
	</div>
@endsection
@section('scripts')
	<script src="{{asset('js/packer.js')}}"></script>
	<script src="{{asset('js/packer.growing.js')}}"></script>
	<script src="{{asset('js/cortes.js')}}"></script>
@endsection
