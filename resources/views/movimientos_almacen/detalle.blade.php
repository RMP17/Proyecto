<div class="d-flex justify-content-center mb-2">
    <div class="col pr-0">
        <div class="form-control border border-info border-top-0 border-right-0 border-bottom-0">
            Categoria: @{{ movimiento_almacen.articulo.one.categoria }}
        </div>
    </div>
    <div class="col pr-0 pl-0">
        <div class="form-control border border-info border-top-0 border-right-0 border-bottom-0">
            Fabricante: @{{ movimiento_almacen.articulo.one.fabricante }}
        </div>
    </div>
    <div class="col pl-0">
        <div class="form-control border border-info border-top-0 border-bottom-0">
            Stock Origen: @{{ movimiento_almacen.articulo.one.stock }}
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mb-2" v-if="!movimiento_almacen.hideSuggestionsArticulo">
    <div class="col pr-0"><input
                class="form-control"
                ref="input_articulo_codigo"
                @keydown.enter="getArticuloByCodigo($event)"
                placeholder="Código del Artículo" type="text"></div>
    <div class="col pr-0 pl-0"><input
                class="form-control"
                ref="input_articulo_codigo_barra"
                @keydown.enter="getArticuloByCodigoBarras($event)"
                placeholder="Código de Barras del Artículo" type="text"></div>
    <div class="col pl-0">
        <app-online-suggestions-objects :config="configArticulo"
                                        :input-value="movimiento_almacen.articulo.tempNombre"
                                        @selected-suggestion-event="selectArticuloMovimientoAlmacen">
        </app-online-suggestions-objects>
    </div>
</div>
<div class="d-flex justify-content-center mb-2">
    <div class="col pr-0">
        <input class="form-control"
               ref="txtCantidad"
               v-model.number="movimiento_almacen.attributes.cantidad"
               placeholder="Cantidad" type="text" @keypress="numberPositiveDirective">
    </div>
    <div class="col pr-0 pl-0">
    </div>
    <div class="col pl-0">
        <button type="button" class="btn btn-info w-100" @click="addToList" >Agregar a la lista</button>
    </div>
</div>
<div class="col">
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th width="20%">Artículo</th>
                <th width="20%">Cantidad</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(_movimiento_almacen,index) in movimiento_almacen.inputs">
                <td>
                    <a href="javascript:void(0)"
                       @click="removeOfList(index)"
                       class="text-danger" title="Quitar"><i class="fas fa-minus fa-lg"></i></a>
                    @{{ _movimiento_almacen.nombre}}
                </td>
                <td >@{{ _movimiento_almacen.cantidad}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


