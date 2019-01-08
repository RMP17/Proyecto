
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                @include('pais.create')
                            </div>
                        </div>
                        <div class="row ">
                        <div class="col-md-2 offset-10 pl-0">
                            <app-online-suggestions :config="pais.config"
                                                    @selected-suggestion-event="getPaisById">
                            </app-online-suggestions>
                        </div>
                        </div>
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col" width="1%">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Ciudades</th>
                                <th scope="col">Agregar Nueva Ciudad</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(_pais, index) in pais.data">
                                <th scope="row">@{{ index+1 }}</th>
                                <td scope="row">@{{ _pais.nombre }}</td>
                                <td scope="row">
                                    <span v-for="ciudad in _pais.ciudades">@{{ ciudad.nombre }}<br></span>
                                </td>
                                <td width="35%">
                                    <form @submit.prevent="addCiudadToPais(_pais)">
                                        <div class="input-group date">
                                            <input type="text" placeholder="Nombre de la Ciudad"
                                                   class="form-control" v-model="pais.ciudad">
                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-outline-success btn-sm">Registrar</button></div>
                                        </div>
                                    </form>
                                </td>
                                <td>
                                    <a href="javascript:void(0)"
                                       @click="modeEditPais(_pais)"
                                       data-backdrop="static"
                                       data-keyboad="false"
                                       data-target="#modal-pais"
                                       data-toggle="modal"
                                       type="button" class="btn btn-warning btn-sm">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    {{--
                                     <a title="Ver ciudades" href="{{URL::action('CiudadControlador@show', $p -> id_pais)}}">
                                        <button type="button" class="btn btn-dark btn-sm"><i class="mdi mdi-plus-circle"></i></button>
                                    </a>
                                    @if ($p -> nombre != 'Bolivia' && $p -> nombre != 'Estados Unidos')


                                        <a title="Eliminar " href="" data-target="#modal-delete-pais-{{$p -> id_pais}}" data-toggle="modal">
                                            <button type="button" class="btn btn-danger btn-sm"><i class="mdi mdi-delete-forever"></i></button>
                                        </a>
                                    @endif
                                --}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--===============================================Modal Edit Pais======================================--}}
    <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-pais">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title pt-1 pr-1">Actualizar País</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    @include('pais.create')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" @click="cancelModeEdit"> Cerrar</button>
                </div>
            </div>
        </div>
    </div>