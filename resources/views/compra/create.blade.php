@extends('maquetas.admin')
@section('page_wrapper')
        <div  class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">

                        <h4 class="page-title">Registrar una compra</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Retornar a la página principal</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="Container-fluid">
                <div class="card-body">
                    <div class="page-breadcrumb">
                        <div class="row">
                            <div class="col-12 d-flex no-block align-items-center">
                                <h4 class="card-title m-b-0">Buscar Artículo</h4>
                                <div class="col-3">
                                    <a href="" data-target="#modal-search-articulo" data-toggle="modal"><button type="button" class="btn btn-outline-dark btn-sm">Buscar</button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li> {{$error}} </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!!Form::open(array('class' => 'form-horizontal', 'url' => 'cliente', 'method' => 'POST', 'autocomplete' => 'off'))!!}
                            {{Form::token()}}
                <div class="container-fluid">
                    @include('compra.articulo') 
                </div>    
            </div>
            <div class="container-fluid">
                @include('compra.search')
            </div>            
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        

        </div>



        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    
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
     <script src="lib/jquery-3.3.1.js"></script>
                <script>
                $("#tabla #fila").click(function () {
                  var mostrar=$(this).find('td:first').html();
                 $('#press').text(mostrar);
                 });
        </script>

@endsection