@extends('maquetas.admin')
@section('page_wrapper')
        
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div id="app-cliente">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">

                        <h4 class="page-title">Lista de clientes</h4>
                        <div class="col-3">
                            <a href data-target="#modal-cliente" data-toggle="modal">
                            <button type="button" class="btn btn-outline-orange">Registrar nuevo</button>
                        </a>
                        </div>


                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{url('')}}">Inicio</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Retornar a la página principal</li>
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
									<h4 class="card-title">Clientes</h4>
									<div class="table-responsive">
										<table id="zero_config" class="table table-striped table-bordered">    
											<thead>
												<tr>
													<th>Razón social</th>
													<th>NIT/CI</th>
													<th>Actividad</th>
													<th>Teléfono</th>
													<th>Celular</th>
													<th>Correo</th>
													<th>Dirección</th>
													<th>Acciones</th>
												</tr>
											</thead>
											<tbody>
                                               @foreach($clientes as $c)
											   @if($c -> id_cliente > 1)
													<tr>
														<td>{{ $c -> razon_social }}</td>
														<td>{{ $c -> nit }}</td>
														<td>{{ $c -> actividad }}</td>
														<td>{{ $c -> telefono }}</td>
														<td>{{ $c -> celular }}</td>
														<td>{{ $c -> correo }}</td>
														<td>{{ $c -> direccion }}</td>
														<td>
															<a href="{{URL::action('ClienteControlador@edit',$c->id_cliente)}}"><button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button></a>
														</td>
													</tr>
												@endif
                                                @endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
                            {{$clientes -> render()}}
						</div>
					</div>
				
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
       
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>


        {{--===============================================Modal Clientes======================================--}}
        <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-cliente">
                    {{-- @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li> {{$error}} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif --}}

            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Registrar Nuevo Cliente
                           <!-- <a type="button" href="" data-target="#modal-create-categoria"
                               data-toggle="modal"
                               class="btn btn-outline-dark"
                               @click="modeCreate=!modeCreate"
                            >
                             <span v-show="modeCreate">Nueva</span>
                                <span v-show="!modeCreate">Ver</span>
                            </a> -->
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                            <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                        </button>
                    </div>
                    <div class="modal-body">
                       <!--
                        <div v-if="!modeCreate">
                            @include('categoria.index')
                        </div>
                        <template v-else>
                            @include('categoria.create')
                        </template>
                    -->
                    @include('cliente.create')
                    
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- ============================================================== -->
    <!-- End Wrapper -->
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