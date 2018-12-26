@extends ('maquetas.admin')
@section ('page_wrapper')


<!DOCTYPE html>
<html dir="empleado" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Custom CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/jquery-minicolors/jquery.minicolors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/libs/quill/dist/quill.snow.css')}}">
    <link href="{{asset('dist/css/style.min.css')}}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
   
 
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
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
                    {!!Form::model($empresa,['method'=>'PATCH','route'=>['empresa.update',$empresa->id_empresa]])!!}
                        {{Form::token()}}
                        <div class="card-body">
                            <h4 class="card-title">Editar la empresa: {{$empresa-> razon_social}}</h4>
                            <div class="form-group row">
                                <label for="txtRazon_social" class="col-sm-3 text-right control-label col-form-label">Razón Social: </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{$empresa->razon_social}}" id="txtRazon_social" placeholder="La razón social de la Empresa " name="txtRazon_social">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txtNit" class="col-sm-3 text-right control-label col-form-label">NIT : </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{$empresa->nit}}" id="txtNit" placeholder="El NIT del cliente aquí" name="txtNit">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txtPropietario" class="col-sm-3 text-right control-label col-form-label">Propietario : </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{$empresa->propietario}}" id="txtPropietario" placeholder="El nombre del propietario de la empresa aquí" name="txtPropietario">
                                </div>
                            </div>                          
                            <div class="form-group row">
                                <label for="txtDireccion" class="col-sm-3 text-right control-label col-form-label">Dirección </label>
                                <div class="col-sm-9">
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{$empresa->direccion}}" id="txtDireccion" placeholder="Dirección aquí" name="txtDireccion">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="rbtSexo0" class="col-sm-3 text-right control-label col-form-label">Casa Matriz : </label>
                                <div class="col-sm-9">
                                    @if ($empresa->casa_matriz==1)
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="rbtCasa1" name="rbtCasa_matriz" required checked value = '1'>
                                        <label class="custom-control-label" for="rbtCasa1">Si</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="rbtCasa0" name="rbtCasa_matriz" required value = '0'>
                                        <label class="custom-control-label" for="rbtCasa0">No</label>
                                    </div>
                                    @else
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="rbtCasa1" name="rbtCasa_matriz" required value = '1'>
                                        <label class="custom-control-label" for="rbtCasa1">Si</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" id="rbtCasa0" name="rbtCasa_matriz" required checked value = '0'>
                                        <label class="custom-control-label" for="rbtCasa0">No</label>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txtActividad" class="col-sm-3 text-right control-label col-form-label">Actividad : </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{$empresa->actividad}}" id="txtActividad" placeholder="Actividad de la empresa aquí" name="txtActividad">
                                </div>
                            </div>
                        </div>      
                        <div class="border-top">
                            <div class="card-body">
                                <button type="submit" class="btn btn-primary">Registrar</button>
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
    <!-- This Page JS -->
    <script src="{{asset('assets/libs/inputmask/dist/min/jquery.inputmask.bundle.min.js')}}"></script>
    <script src="{{asset('dist/js/pages/mask/mask.init.j')}}"></script>
    <script src="{{asset('assets/libs/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-asColor/dist/jquery-asColor.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-asGradient/dist/jquery-asGradient.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-asColorPicker/dist/jquery-asColorPicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/jquery-minicolors/jquery.minicolors.min.js')}}"></script>
    <script src="{{asset('assets/libs/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{asset('assets/libs/quill/dist/quill.min.js')}}"></script>
    <script>
        //***********************************//
        // For select 2
        //***********************************//
        $(".select2").select2();

        /*colorpicker*/
        $('.demo').each(function() {
        //
        // Dear reader, it's actually very easy to initialize MiniColors. For example:
        //
        //  $(selector).minicolors();
        //
        // The way I've done it below is just for the demo, so don't get confused
        // by it. Also, data- attributes aren't supported at this time...they're
        // only used for this demo.
        //
        $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                position: $(this).attr('data-position') || 'bottom left',

                change: function(value, opacity) {
                    if (!value) return;
                    if (opacity) value += ', ' + opacity;
                    if (typeof console === 'object') {
                        console.log(value);
                    }
                },
                theme: 'bootstrap'
            });

        });
        /*datwpicker*/
        jQuery('.mydatepicker').datepicker();
        jQuery('#datepicker-autoclose').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        var quill = new Quill('#editor', {
            theme: 'snow'
        });

    </script>
</body>

</html>
@endsection