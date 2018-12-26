@extends('maquetas.admin')
@section('page_wrapper')

        
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Sucursales</h4>
						<div class="col-3">
                            <a type="button" class="btn btn-outline-dark" href="{{URL::action('SucursalControlador@create',$id_empresa)}}">Agregar registro</a>
                        </div>
                        
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('/')}}">Inicio</a></li>
                                    <li class="breadcrumb-item">Retornar Inicio</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
					<div class="row">
						<div class="col-12">                      
							<div class="card">
								<div class="card-body">
                                   
                                   
									<div class="table-responsive">
										<table id="zero_config" class="table table-striped table-bordered">
											<thead>
												<tr>
													<th>Nombre</th>
													<th>Dirección</th>
													<th>Teléfono</th>
                                                    <th>Fecha Apertura</th>
													<th>Ciudad</th>
                                                    <th>Estado</th>
													<th>Acciones</th>
												</tr>
											</thead>
                                        
											<tbody>
                                               @foreach($sucursales as $s)
                                                <tr>
                                                  <td>{{ $s ->nombre_sucursal }}</td>
                                                  <td>{{ $s ->direccion }}</td>
                                                  <td>{{ $s ->telefono}}</td>
                                                  <td>{{ $s ->fecha_apertura}}</td>
												  <td>{{ $s ->nombre_ciudad}}</td>
                                                   @if($s->estatus=='A')
                                                    <td> <span class="waves-effect waves-light btn btn-primary btn-sm">Activo</span> </td>
													<td>
														<a title="Editar" href="{{URL::action('SucursalControlador@edit',$s->id_sucursal)}}" type="submit" class="btn btn-warning btn-sm"> <i class="mdi mdi-pencil"></i></a>
														<a title="Dar de baja" href="" data-target="#modal-delete-{{$s->id_sucursal}}" data-toggle="modal" type="submit"  class="btn btn-danger btn-sm"><i class="mdi mdi-thumb-down"></i></a>
														<a title="Registrar almacen" href="{{URL::action('AlmacenControlador@show', $s -> id_sucursal)}}"><button type="button" class="btn btn-dark btn-sm"><i class="mdi mdi-plus-circle"></i></button></a>
													</td>
                                                    @else
                                                    <td ><span class="waves-effect waves-light btn btn-default btn-sm" style="background: red">Baja</span> </td> 
													<td> </td>
                                                    @endif
                                                </tr>
                                                @include('sucursal.destroy')
                                                @endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
                          
						</div>
					</div>
				
               
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
      
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{asset('assets/libs/popper.js/dist/umd/popper.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{asset('assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js')}}"></script>
    <script src="{{asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>
    <!--Wave Effects -->
    <script src="{{asset('dist/js/waves.js')}}"></script>
    <!--Menu sidebar -->
    <script src="{{asset('dist/js/sidebarmenu.js')}}"></script>
    <!--Custom JavaScript -->
    <script src="{{asset('dist/js/custom.min.js')}}"></script>
    <!-- this page js -->
    <script src="{{asset('assets/extra-libs/multicheck/datatable-checkbox-init.js')}}"></script>
    <script src="{{asset('assets/extra-libs/multicheck/jquery.multicheck.js')}}"></script>
    <script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
    <script>
        /****************************************
         *       Basic Table                   *
         ****************************************/
        $('#zero_config').DataTable();
    </script>

@endsection