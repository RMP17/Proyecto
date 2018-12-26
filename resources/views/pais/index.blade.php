@extends('maquetas.admin')
@section('page_wrapper')
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h4 class="page-title">Lista de Países</h4>
                <div class="col-3">
                    <a href="" data-target="#modal-create-pais" data-toggle="modal">
                        <button type="button" class="btn btn-outline-dark">Nuevo País</button>
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($paises as $p)
                            <tr>
                                <th scope="row">{{$i}}</th>
                                <td>{{ $p -> nombre }}</td>
                                <td>
                                     <a title="Ver ciudades" href="{{URL::action('CiudadControlador@show', $p -> id_pais)}}">
                                        <button type="button" class="btn btn-dark btn-sm"><i class="mdi mdi-plus-circle"></i></button>
                                    </a>
                                    @if ($p -> nombre != 'Bolivia' && $p -> nombre != 'Estados Unidos')

                                        <a href="" data-target="#modal-edit-pais-{{$p -> id_pais}}" data-toggle="modal">
                                            <button title="Editar" type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button>
                                        </a>
                                        <a title="Eliminar " href="" data-target="#modal-delete-pais-{{$p -> id_pais}}" data-toggle="modal">
                                            <button type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-delete-forever"></i></button>
                                        </a>
                                        <div>
                                            <div>@include ('pais.edit')</div>
                                        </div>
                                        <div>
                                            <div>@include ('pais.destroy')</div>
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                {{$paises -> render()}}
            </div>
            @include ('pais.create')
        </div>
    </div>
@endsection