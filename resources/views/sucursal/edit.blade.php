
@extends('maquetas.admin')
@section('page_wrapper')
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
					{!!Form::model($sucursal,['method'=>'PATCH','route'=>['sucursal.update',$sucursal->id_sucursal]])!!}
						{{Form::token()}}
						<div class="card-body">
							<h4 class="card-title">Modificar Sucursal : {{$sucursal -> nombre}}</h4>
							<div class="form-group row">
                                <label for="txtNombre" class="col-sm-3 text-right control-label col-form-label">Nombre: </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="txtNombre" placeholder="El nombre de la sucursal aquí" name="txtNombre" value="{{$sucursal->nombre}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                 <label for="rbtCasaMatriz0" class="col-sm-3 text-right control-label col-form-label">Casa Matriz : </label>
                                <div class="col-sm-9">

                                   @if($sucursal -> casa_matriz == '0')
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="rbtCasaMatriz0" name="rbtCasaMatriz" required checked value = '0'>
                                            <label class="custom-control-label" for="rbtCasaMatriz0">No</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="rbtCasaMatriz1" name="rbtCasaMatriz" required value = '1'>
                                            <label class="custom-control-label" for="rbtCasaMatriz1">Si</label>
                                        </div>
                                    @else
                                       <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="rbtCasaMatriz0" name="rbtCasaMatriz" required value = '0'>
                                            <label class="custom-control-label" for="rbtCasaMatriz0">No</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="rbtCasaMatriz1" name="rbtCasaMatriz" required checked value = '1'>
                                            <label class="custom-control-label" for="rbtCasaMatriz1">Si</label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="txtDireccion" class="col-sm-3 text-right control-label col-form-label">Dirección : </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" id="txtDireccion" placeholder="Dirección de la sucursal aquí" name="txtDireccion" value="{{$sucursal->direccion}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="txtTelefono" class="col-sm-3 text-right control-label col-form-label">Teléfono : </label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="txtTelefono" placeholder="Número telefónico de la sucursal aquí" name="txtTelefono" onkeypress="return ValidarNumeroTecleado(event)" onblur="ValidarNumeroPegado(event, this.id)" value="{{$sucursal->telefono}}">
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="datepicker-autoclose" class="col-sm-3 text-right control-label col-form-label">Fecha Apertura : </label>
                                <div class="col-sm-9">
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="datepicker-autoclose" placeholder="yyyy/mm/dd" name="dtmFechaApertura" value="{{$sucursal->fecha_apertura}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>   
                          <div class="form-group row">
                                 <label for="cbxPais" class="col-sm-3 text-right control-label col-form-label">País : </label>
                                    <div class="col-sm-9">
                                        <div class="col-md-9">
                                            <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxPais" name="cbxPais">
                                                    <option value={{$pais -> id_pais}}> Actual : {{$pais ->nombre}}</option>
                                                @foreach($paises as $p)
                                                    <option value={{$p -> id_pais}}>{{$p ->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                            </div>
                            <div class="form-group row">
                                <label for="cbxCiudad" class="col-sm-3 text-right control-label col-form-label">Ciudad : </label>
                                <div class="col-sm-9">
                                    <div class="col-md-9">
                                        <select class="select2 form-control custom-select" style="width: 100%; height:36px;" id="cbxCiudad" name="cbxCiudad">
                                            <option value="$ciudad -> id_ciudad">Actual : {{$ciudad->nombre}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>   
							<input type="hidden" class="form-control" id="cbxEmpresa" placeholder="" name="cbxEmpresa" value="{{$sucursal->id_empresa}}"> 
						</div>		
						<div class="border-top">
							<div class="card-body">
								<button type="submit" class="btn btn-primary">Modificar</button>
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
@endsection