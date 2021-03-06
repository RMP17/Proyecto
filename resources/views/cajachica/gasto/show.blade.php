@include('cajachica.gasto.create')
<div class="row mb-3">
    <div class="col-md-8 offset-2 pr-5 pl-5">
        <app-dates @date-range="getGastosByRangeDate"></app-dates>
    </div>
</div>
<div class="d-md-flex flex-row">
    <div v-if="!caja.gasto.hideFilters">
        <app-online-suggestions-objects :config="configEmpleado"
                                        @selected-suggestion-event="filterByEmpleado">
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
               @click="removeFilters"
            ><i class="fas fa-ban fa-lg"></i>
            </a>
            <a href="javascript:void(0);" type="button"
               title="Exportar a PDF"
               @click="exportPdf"
               class="btn btn-outline-danger"
            ><i class="far fa-file-pdf fa-lg"></i>
            </a>
            <a href="javascript:void(0);" type="button"
               title="Átras"
               class="btn btn-outline-secondary"
               :class="caja.gasto.paginated.pageNumber === 0 ? 'disabled':''"
               @click="prevPage"
            ><i class="fas fa-arrow-left fa-lg"></i>
            </a>
            <div class="input-group-prepend">
                <span title="Página actual" class="input-group-text">
                    @{{ caja.gasto.paginated.pageNumber+1 }}
                </span>
            </div>

            <a href="javascript:void(0);" type="button"
               title="Siguiente"
               class="btn btn-outline-secondary"
               :class="caja.gasto.paginated.pageNumber >= pageCount -1 ? 'disabled':''"
               @click="nextPage"
            ><i class="fas fa-arrow-right fa-lg"></i>
            </a>
        </div>
    </div>
</div>

<table class="table table-striped table-bordered table-sm">
    <thead>
    <tr>
        <th>Fecha y hora</th>
        <th>Empleado</th>
        <th>Caja</th>
        <th>Monto</th>
        <th>Descripción</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="gasto in paginatedData">
        <td>@{{ gasto.fecha }}</td>
        <td>@{{ gasto.empleado }}</td>
        <td>@{{ gasto.caja }}</td>
        <td>@{{ gasto.monto }}</td>
        <td>@{{ gasto.descripcion }}</td>
    </tr>
    </tbody>
</table>
<table v-show="false" id="print-gastos">
    <thead>
    <tr>
        <th>Fecha y hora</th>
        <th>Empleado</th>
        <th>Caja</th>
        <th>Monto</th>
        <th>Descripción</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="gasto in paginatedData">
        <td>@{{ gasto.fecha }}</td>
        <td>@{{ gasto.empleado }}</td>
        <td>@{{ gasto.caja }}</td>
        <td>@{{ gasto.monto }}</td>
        <td>@{{ gasto.descripcion }}</td>
    </tr>
    </tbody>
</table>