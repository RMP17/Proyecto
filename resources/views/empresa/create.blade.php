@extends('maquetas.admin')
@section('page_wrapper')
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
                {!!Form::open(array('class' => 'form-horizontal', 'url' => 'empresa', 'method' => 'POST', 'autocomplete' => 'off'))!!}
                {{Form::token()}}
                <div class="card-body">
                    <h4 class="card-title">Datos de registro de la empresa</h4>
                    <div class="form-group row">
                        <label for="txtRazon_social" class="col-sm-3 text-right control-label col-form-label">Razón
                            Social: </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="txtRazon_social"
                                   placeholder="El nombre o razón sicial de la empresa aquí" name="txtRazon_social">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txtNit" class="col-sm-3 text-right control-label col-form-label">NIT : </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="txtNit" placeholder="El NIT de la empresa aquí"
                                   name="txtNit">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txtPropietario" class="col-sm-3 text-right control-label col-form-label">Propietario
                            : </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="txtPropietario"
                                   placeholder="El nombre ddel propietario de la empresa aquí" name="txtPropietario">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="txtActividad" class="col-sm-3 text-right control-label col-form-label">Actividad
                            : </label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="txtActividad"
                                   placeholder="Describa la actividad o actividades de la empresa aquí"
                                   name="txtActividad">
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
@endsection
