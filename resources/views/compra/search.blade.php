
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-search-articulo">
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li> {{$error}} </li>
						@endforeach
					</ul>
				</div>
			@endif
			{!!Form::open(array('url' => 'compra/create', 'method' => 'GET', 'autocomplete' => 'off','role'=>'search' ))!!}

			<div class="modal-dialog" >
					<div class="modal-content" style="width: 600px">
						<div class="modal-header">
							<h4 class="modal-title"> Artículos </h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
							<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
							</button>
						</div>
						<div class="modal-body">	
							<div class="form-group row">
								<div class="form-group">
									<div class="input-group">
										<div class="row">
											<div class="col-12">                      
													<div class="card">
														<div  class="card-body">
														<h5 class="card-title">Busque y seleccione el artículo de la tabla </h5>
														<div class="table-responsive" id="tabla">
															<table id="zero_config" class="table table-striped table-bordered">
																<thead>
																	<tr>
																		<th>Nombre</th>
																		<th>Codigo</th>
																		<th>Cod. Barra</th>
																		<th>Características</th>
																		<th hidden></th>
																	</tr>
																</thead>
																<tbody>
																	 @foreach($articulos as $a)
																		<tr id="fila">
																			<td hidden id="idA" value="{{ $a -> id_articulo }}"> {{ $a -> id_articulo }}</td>
																			<td >{{ $a -> nombre }}</td>
																			<td >{{ $a -> codigo}}</td>
																			<td >{{ $a -> codigo_barra }}</td>
																			<td >{{ $a -> caracteristicas}}</td>	
																		</tr>
																	@endforeach
																</tbody>
															</table>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>	
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar </button>
						</div>		
					</div>
				</div>
				
		{{Form::Close()}}
<div>
