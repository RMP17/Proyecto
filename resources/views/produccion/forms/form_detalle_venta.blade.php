<div class="d-flex justify-content-center mb-2" v-if="!produccion.hideSuggestionsArticulo">
    <div class="col-lg-4 pr-0"><input
                class="form-control"
                ref="input_articulo_codigo_pro"
                @keydown.enter="getArticuloByCodigo($event)"
                placeholder="Código del Artículo" type="text"></div>
    <div class="col-lg-4 pr-0 pl-0"><input
                class="form-control"
                ref="input_articulo_codigo_barra_pro"
                @keydown.enter="getArticuloByCodigoBarras($event)"
                placeholder="Código de Barras del Artículo" type="text"></div>
    <div class="col-lg-4 pl-0" >
        <app-online-suggestions-objects :config="configArticulo"
                                        :input-value="this.produccion.articulo.name"
                                        @selected-suggestion-event="selectArticuloOfSuggestions">
        </app-online-suggestions-objects>
    </div>
</div>
<div class="d-flex justify-content-center mb-2">
    <div class="col-lg-4 pr-0">
        <div class="form-control border border-info border-right-0 border-left-0">
            Categoria: @{{ produccion.articulo.attributes.categoria ? produccion.articulo.attributes.categoria.categoria:'' }}
        </div>
    </div>
    <div class="col-lg-4 pr-0 pl-0">
        <div class="form-control border border-info border-right-0 border-left-0">
            Fabricante: @{{ produccion.articulo.attributes.fabricante ? produccion.articulo.attributes.fabricante.nombre:'' }}
        </div>
    </div>
    <div class="col-lg-4 pl-0">
        <div class="form-control border border-info border-right-0 border-left-0">
            {{--todo:stock muestra los articulos del almacen asignado--}}
            Stock: @{{ produccion.articulo.attributes.stock }}
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mb-2">
    <div class="col-lg-4 pr-0"><input
                class="form-control"
                ref="txtCantidadProduccion"
                v-model.number ="produccion.detalle.attributes.cantidad"
                placeholder="Cantidad" type="text" @keypress="numberPositiveDirective">
    </div>
    <div class="col-lg-4 pr-0 pl-0">
        <select class="custom-select"
                @change="selectIdSucursal"
                v-model.numeric="produccion.detalle.attributes.precio_unitario">
            <option :value="null" selected disabled>Seleccione un precio...</option>
            <template v-if="Object.keys(produccion.articulo.attributes.precios).length>0">
                <option :value="produccion.articulo.attributes.precios.precio_1">@{{ produccion.articulo.attributes.precios.precio_1 }}</option>
                <option :value="produccion.articulo.attributes.precios.precio_2">@{{ produccion.articulo.attributes.precios.precio_2 }}</option>
                <option :value="produccion.articulo.attributes.precios.precio_3">@{{ produccion.articulo.attributes.precios.precio_3 }}</option>
                <option :value="produccion.articulo.attributes.precios.precio_4">@{{ produccion.articulo.attributes.precios.precio_4 }}</option>
                <option :value="produccion.articulo.attributes.precios.precio_5">@{{ produccion.articulo.attributes.precios.precio_5 }}</option>
            </template>
        </select>
    </div>
    <div class="col-lg-4 pl-0">
        <button type="button" class="btn w-100" :class="produccion.detalle.attributes.id_articulo  ?  'btn-info':'btn-secondary'" @click="addToListAndRemove">Agregar a la lista y borrar</button>
    </div>
</div>
<div class="d-flex justify-content-center mb-4">
    <div class="col-lg-4 pr-0"><input
                class="form-control"
                v-model.number ="produccion.detalle.attributes.ancho"
                placeholder="Ancho [cm]" type="text" @keypress="numberFloatDirective">
    </div>
    <div class="col-lg-4 pr-0 pl-0"><input
                class="form-control"
                v-model.number ="produccion.detalle.attributes.largo"
                placeholder="Largo [cm]" type="text" @keypress="numberFloatDirective">
    </div>
    <div class="col-lg-4 pl-0">
        <button type="button" class="btn w-100" :class="produccion.detalle.attributes.id_articulo  ?  'btn-info':'btn-secondary'" @click="addToList">Agregar a la lista</button>
    </div>
</div>
<div class="col">
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            <tr>
                <th>Artículo</th>
                <th width="20%">Cantidad</th>
                <th width="20%">Precio Unitario</th>
                <th width="20%">Subtotal</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(detalle,index) in produccion.attributes.detalles">
                <td title="Ancho X Largo">
                    <a href="javascript:void(0)"
                       @click="removeOfList(index)"
                       class="text-danger" title="Quitar"><i class="fas fa-minus fa-lg"></i></a>
                    <span v-if="detalle.ancho">
                        @{{ detalle.nombre}} <strong>@{{detalle.ancho+'x'+detalle.largo }}</strong>
                    </span>
                    <span v-else>@{{ detalle.nombre}}</span>
                </td>
                <td class="text-right pr-3">@{{ detalle.cantidad}}</td>
                <td class="text-right pr-3">@{{ detalle.precio_unitario}}</td>
                <td class="text-right pr-3">@{{ detalle.subtotal}}</td>
            </tr>
            <tr>
                <th>TOTAL</th>
                <td colspan="3" class="text-right pr-3">
                    @{{ produccion.totalDetalles}}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


