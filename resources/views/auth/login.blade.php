@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Inicio de Sesión</div>

                <div class="panel-body">
                    <div class="col-md-12 text-center">
                        <img src="{{asset('images/tabletec-logo-2018.png')}}" width="400">
                    </div>
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}" autocomplete="off">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            {{--<label for="email" class="col-md-4 control-label">Nombre de Usuario</label>--}}
                            <div class="col-md-10 col-md-offset-1">
                                <input id="email" type="text" placeholder="Nombre de Usuario" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                @if (session('error_login'))
                                    <span>
                                        <strong class="text-danger">{{ session('error_login') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            {{--<label for="password" class="col-md-4 control-label">Contraseña</label>--}}

                            <div class="col-md-10 col-md-offset-1">
                                <input id="password" placeholder="Contraseña"
                                       autocomplete="off"
                                       type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" class="" {{ old('remember') ? 'checked' : '' }}> Recordar mi cuenta
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-danger" style="width: 25%">
                                Iniciar Sesión
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
