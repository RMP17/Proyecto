
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
                        <div class="form-row">
                            <div class="col-md-4 offset-lg-6">
                                <app-online-suggestions :config="pais.config"
                                                        @selected-suggestion-event="getPaisById">
                                </app-online-suggestions>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-outline-secondary w-100" @click="getPaises">Ver todos los países</button>
                            </div>
                        </div>
                        <table class="table table-striped table-bordered table-sm">
                            <thead>
                            <tr>
                                <th scope="col" width="2%">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(_pais, index) in pais.data">
                                <th scope="row">@{{ index+1 }}</th>
                                <td scope="row">@{{ _pais.nombre }}</td>
                                <td>
                                    <a href="javascript:void(0)"
                                       @click="modeEditPais(_pais)"
                                       data-backdrop="static"
                                       data-keyboard="false"
                                       data-target="#modal-pais"
                                       data-toggle="modal"
                                       type="button" class="btn btn-warning btn-sm">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                    <a href="javascript:void(0)"
                                       @click="showCities(_pais)"
                                       data-backdrop="static"
                                       data-keyboard="false"
                                       data-target="#modal-cities"
                                       data-toggle="modal"
                                       type="button" class="btn btn-info btn-sm lh-1">
                                        <i class="mdi mdi-city mdi-18px"></i>
                                    </a>
                                </td>
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
                    <button type="button" class="close" @click="cancelModeEdit" data-dismiss="modal" aria-label="Cerrar">
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
    {{--===============================================Modal Show Cities======================================--}}
    <div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog"
         tabindex="-1"
         id="modal-cities">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title pt-1 pr-1">Ciudades de @{{  pais.onePais? pais.onePais.nombre:'' }}</h4>
                    <a v-show="!pais.ciudad.modeEdit" href
                       data-toggle="modal"
                       class="btn btn-outline-dark w-10em"
                       @click="pais.ciudad.modeCreate=!pais.ciudad.modeCreate"
                    >
                        <span v-show="!pais.ciudad.modeCreate">Nueva</span>
                        <span v-show="pais.ciudad.modeCreate">Ver</span>
                    </a>

                    <button type="button" class="close"
                            @click="cancelModeEditCiudad"
                            data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                    </button>
                </div>
                <div class="modal-body pb-0">
                    <div v-if="!pais.ciudad.modeCreate">
                        @include('pais.ciudad.show')
                    </div>
                    <div v-else>
                        @include('pais.ciudad.create')
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal" @click="cancelModeEditCiudad"> Cerrar</button>
                </div>
            </div>
        </div>
    </div>