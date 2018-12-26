@extends('maquetas.admin')
@section('page_wrapper')
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<div class="page-breadcrumb">
							<div class="row">
								<div class="col-12 d-flex no-block align-items-center">
									<h4 class="card-title m-b-0">Observaciones</h4>
									<div class="col-3">
										<a href="" data-target="#modal-create-kardexO-{{$id_kardex}}" data-toggle="modal"><button type="button" class="btn btn-outline-dark btn-sm">Nuevo</button></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<table class="table">
						  <thead>
							<tr>
							  <th scope="col">#</th>
							  <th scope="col">Observación</th>
							  <th scope="col">Fecha</th>
							  <th scope="col">Acciones</th>
							</tr>
						  </thead>
						  <tbody>
						  <?php $i = 1; ?>
						  @foreach($kardexO as $ko)
							<tr>
							  <th scope="row">{{$i}}</th>
							  <td>{{ $ko -> observacion}}</td>
							   <td>{{ $ko -> fecha}}</td>
							  <td>
									<a title="Editar" href="" data-target="#modal-edit-kardexO-{{$ko -> id_kardex}}" data-toggle="modal"><button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button></a>

                                     <a titles="Eliminar" href="" data-target="#modal-delete-kardexO-{{$ko->id_kardex}}" data-toggle="modal"><button type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-delete-forever"></i></button></a>

									<div><div>@include ('kardex.kardex_observaciones.edit')</div></div>
									<div><div>@include ('kardex.kardex_observaciones.destroy')</div></div>
							  </td>
							</tr>
							<?php $i++; ?>
							@endforeach
						  </tbody>
					</table>
				</div>
				{{$kardexO -> render()}}
			</div>
			@include ('kardex.kardex_observaciones.create')
		</div>
@endsection
	