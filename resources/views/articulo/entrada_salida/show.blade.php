<!-- ============================================================== -->
<!-- Start Page Content -->
<!-- ============================================================== -->
<div class="col-12 p-0">
    <div class="row mb-3">
        <div class="col-md-12 pr-5 pl-5">
            <app-dates @date-range="getEntradaSalidaArticuloByRageDate"></app-dates>
        </div>
    </div>
    <div class="d-md-flex flex-row">
        <div class="col p-0" v-if="!entradaSalidaArticulos.hideFilters">
            <app-online-suggestions-objects :config="configEmpleado"
                                            @selected-suggestion-event="filterByEmpleado">
            </app-online-suggestions-objects>
        </div>
        <div v-if="!entradaSalidaArticulos.hideFilters">
            <select class="custom-select"
                    @change="filterByAlmacen"
                    name="slctFilterAlmacen">
                <option :value="null" disabled selected>Seleccione Almacen</option>
                <option v-for="_almacen in almacenes" :value="_almacen.id_almacen">
                    @{{ _almacen.codigo }}
                </option>
            </select>
        </div>
        <div v-if="!entradaSalidaArticulos.hideFilters">
            <select class="custom-select"
                    @change="filterByActividad"
                    @mousewheel=""
                    name="slctFilterActividad">
                <option value="" selected>Seleccione Actividad</option>
                <option value="e" >Ingresos</option>
                <option value="s" >Salidas</option>
            </select>
        </div>
        <div class="ml-auto">
            <div class="input-group">
                <a href="javascript:void(0);" type="button"
                   title="Límpiar filtros"
                   class="btn btn-outline-secondary"
                   @click="removeFilters"
                ><i class="fas fa-ban fa-lg"
                    ></i></a>
                {{--<a href="javascript:void(0);" type="button"
                   title="Exportar a PDF"
                   @click="exportPdf"
                   class="btn btn-outline-danger"
                ><i class="far fa-file-pdf fa-lg"
                    ></i></a>--}}
                <a href="javascript:void(0);" type="button"
                   title="Átras"
                   class="btn btn-outline-secondary"
                   :class="entradaSalidaArticulos.paginated.pageNumber === 0 ? 'disabled':''"
                   @click="prevPageEntradasSalidas"
                ><i class="fas fa-arrow-left fa-lg"
                    ></i></a>
                <div class="input-group-prepend">
                                            <span title="Página actual" class="input-group-text">
                                            @{{ entradaSalidaArticulos.paginated.pageNumber+1 }}
                                            </span>
                </div>
                <a href="javascript:void(0);" type="button"
                   title="Siguiente"
                   class="btn btn-outline-secondary"
                   :class="entradaSalidaArticulos.paginated.pageNumber >= pageCountEntradasSalidas -1 ? 'disabled':''"
                   @click="nextPageEntradasSalidas"
                ><i class="fas fa-arrow-right fa-lg"
                    ></i></a>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead>
            <tr>
                <th>Fecha y hora</th>
                <th>Empleado</th>
                <th>Álmacen</th>
                <th>Árticulo</th>
                <th>Cantidad</th>
                <th>Actividad</th>
                <th>Observaciones</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="_entradaSalida in paginatedDataEntradasSalidas">
                <td>@{{ _entradaSalida.fecha }}</td>
                <td>@{{ _entradaSalida.empleado }}</td>
                <td>@{{ _entradaSalida.almacen }}</td>
                <td>@{{ _entradaSalida.articulo }}</td>
                <td>@{{ _entradaSalida.cantidad }}</td>
                <td>
                    <span v-if="_entradaSalida.actividad ==='e'">Ingreso</span>
                    <span v-if="_entradaSalida.actividad ==='s'">Salio</span>
                </td>
                <td>@{{ _entradaSalida.observaciones }}</td>
            </tr>
            </tbody>
        </table>
    </div>

</div>

<!-- ============================================================== -->
<!-- End PAge Content -->
<!-- ============================================================== -->