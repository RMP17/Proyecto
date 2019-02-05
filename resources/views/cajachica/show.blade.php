<div class="row mb-3">
    <div class="col-md-8 offset-2 pr-5 pl-5">
        <app-dates @date-range="getCajaChicaByRangeDate"></app-dates>
    </div>
</div>
<div class="d-md-flex flex-row">
    <div v-if="!caja.registro.hideFilters">
        <app-online-suggestions-objects :config="configCaja"
                                        @selected-suggestion-event="filterByCaja">
        </app-online-suggestions-objects>
    </div>
    {{--<div v-if="!caja.gasto.hideFilters">
        <select class="custom-select"
                @change="filterByAlmacen"
                name="cbxFilterAlmacen">
            <option :value="null" disabled selected>Seleccione Almacen</option>
            <option v-for="_almacen in almacenes" :value="_almacen.id_almacen">
                @{{ _almacen.codigo }}
            </option>
        </select>
    </div>--}}
    <div class="ml-auto">
        <div class="input-group">
            <a href="javascript:void(0);" type="button"
               title="Límpiar filtros"
               class="btn btn-outline-secondary"
               @click="removeFiltersOfCaja"
            ><i class="fas fa-ban fa-lg"></i>
            </a>
            <a href="javascript:void(0);" type="button"
               title="Exportar a PDF"
               @click="exportPdfCajasChicas"
               class="btn btn-outline-danger"
            ><i class="far fa-file-pdf fa-lg"></i>
            </a>
            <a href="javascript:void(0);" type="button"
               title="Átras"
               class="btn btn-outline-secondary"
               :class="caja.registro.paginated.pageNumber === 0 ? 'disabled':''"
               @click="prevPageOfCaja"
            ><i class="fas fa-arrow-left fa-lg"></i>
            </a>
            <div class="input-group-prepend">
                <span title="Página actual" class="input-group-text">
                    @{{ caja.registro.paginated.pageNumber+1 }}
                </span>
            </div>

            <a href="javascript:void(0);" type="button"
               title="Siguiente"
               class="btn btn-outline-secondary"
               :class="caja.registro.paginated.pageNumber >= pageCountOfRegisterBox -1 ? 'disabled':''"
               @click="nextPageOfCaja"
            ><i class="fas fa-arrow-right fa-lg"></i>
            </a>
        </div>
    </div>
</div>

<table class="table table-striped table-bordered table-sm">
    <thead>
    <tr>
        <th>Caja</th>
        <th>Fecha y hora de apertura</th>
        <th>Fecha y hora de Cierre</th>
        <th>Monto apertura</th>
        <th>Monto declarado</th>
        <th>Diferencia</th>
        <th>Observaciones</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="caja in paginatedRegisterBox">
        <td>@{{ caja.caja }}</td>
        <td>@{{ caja.fecha_apertura }}</td>
        <td>@{{ caja.fecha_cierre }}</td>
        <td>@{{ caja.monto_apertura }}</td>
        <td>@{{ caja.monto_declarado }}</td>
        <td>@{{ caja.diferencia }}</td>
        <td>@{{ caja.observaciones }}</td>
    </tr>
    </tbody>
</table>
<table v-show="false" id="print-cajas">
    <thead>
    <tr>
        <th>Caja</th>
        <th>Fecha y hora de apertura</th>
        <th>Fecha y hora de Cierre</th>
        <th>Monto apertura</th>
        <th>Monto declarado</th>
        <th>Diferencia</th>
        <th>Observaciones</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="caja in paginatedRegisterBox">
        <td>@{{ caja.caja }}</td>
        <td>@{{ caja.fecha_apertura }}</td>
        <td>@{{ caja.fecha_cierre }}</td>
        <td>@{{ caja.monto_apertura }}</td>
        <td>@{{ caja.monto_declarado }}</td>
        <td>@{{ caja.diferencia }}</td>
        <td>@{{ caja.observaciones }}</td>
    </tr>
    </tbody>
</table>