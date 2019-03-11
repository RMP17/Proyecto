<div class="d-flex justify-content-center mb-2" v-if="!venta.hideSuggestionsArticulo">
    <div class="col-lg-4 pr-0"><input
                class="form-control"
                ref="input_articulo_codigo"
                @keydown.enter="getArticuloByCodigo($event)"
                placeholder="Código del Artículo" type="text"></div>
    <div class="col-lg-4 pr-0 pl-0"><input
                class="form-control"
                ref="input_articulo_codigo_barra"
                @keypress.enter="getArticuloByCodigoBarras($event)"
                placeholder="Código de Barras del Artículo" type="text"></div>
    <div class="col-lg-4 pl-0">
        <app-online-suggestions-objects :config="configArticulo"
                                        :input-value="venta.nameArticulo"
                                        @selected-suggestion-event="assignAnIdentificationOfArticuloToDetalleVenta">
        </app-online-suggestions-objects>
    </div>
</div>
<div class="d-flex justify-content-center mb-2">
    <div class="col-lg-4 pr-0">
        <div class="form-control border border-info border-right-0 border-left-0">
            Categoria: @{{ venta.articulo.categoria ? venta.articulo.categoria.categoria:'' }}
        </div>
    </div>
    <div class="col-lg-4 pr-0 pl-0">
        <div class="form-control border border-info border-right-0 border-left-0">
            Fabricante: @{{ venta.articulo.fabricante ? venta.articulo.fabricante.nombre:'' }}
        </div>
    </div>
    <div class="col-lg-4 pl-0">
        <div class="form-control border border-info border-right-0 border-left-0">
            {{--todo:stock muestra los articulos del almacen asignado--}}
            Stock: @{{ venta.articulo.stock }}
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mb-4">
    <div class="col-lg-4 pr-0"><input
                class="form-control"
                ref="txtCantidad"
                v-model.number ="venta.detalleVenta.cantidad"
                placeholder="Cantidad" type="text" @keypress="numberPositiveDirective"></div>
    {{--<div class="col-lg-4 pr-0 pl-0">
        <input  @keypress.enter="addDetalleVenta"
                class="form-control"
                v-model.number="venta.detalleVenta.precio_unitario"
                placeholder="Precio Unitario" type="text" @keypress="numberFloatDirective">
    </div>--}}
    <div class="col-lg-4 pr-0 pl-0">
        <select class="custom-select"
                @change="selectIdSucursal"
                v-model.number="venta.detalleVenta.precio_unitario">
            <option :value="null" selected disabled>Seleccione un precio...</option>
            <template v-if="Object.keys(venta.articulo.precios).length>0">
                <option v-if="venta.articulo.precios.precio_1" :value="Number(venta.articulo.precios.precio_1)">@{{ venta.articulo.precios.precio_1 }}</option>
                <option v-if="venta.articulo.precios.precio_2" :value="Number(venta.articulo.precios.precio_2)">@{{ venta.articulo.precios.precio_2 }}</option>
                <option v-if="venta.articulo.precios.precio_3" :value="Number(venta.articulo.precios.precio_3)">@{{ venta.articulo.precios.precio_3 }}</option>
                <option v-if="venta.articulo.precios.precio_4" :value="Number(venta.articulo.precios.precio_4)">@{{ venta.articulo.precios.precio_4 }}</option>
                <option v-if="venta.articulo.precios.precio_5" :value="Number(venta.articulo.precios.precio_5)">@{{ venta.articulo.precios.precio_5 }}</option>
            </template>
        </select>
    </div>
    <div class="col-lg-4 pl-0">
        <button type="button" class="btn w-100" :class="venta.detalleVenta.id_articulo ?  'btn-info':'btn-secondary'" @click="addDetalleVenta">Agregar a la lista y borrar</button>
    </div>
</div>
<div class="d-flex justify-content-center mb-4">
        <div class="col-lg-4 pr-0"><input
                    class="form-control"
                    v-model.number ="venta.detalleVenta.ancho"
                    :disabled="!venta.articulo || !venta.articulo.divisible ? true:false"
                    placeholder="Ancho [cm]" type="text" @keypress="numberFloatDirective">
        </div>
        <div class="col-lg-4 pr-0 pl-0"><input
                    class="form-control"
                    v-model.number ="venta.detalleVenta.largo"
                    @keypress.enter="addToList"
                    :disabled="!venta.articulo || !venta.articulo.divisible ? true:false"
                    placeholder="Largo [cm]" type="text" @keypress="numberFloatDirective">
        </div>
        <div class="col-lg-4 pl-0">
            <button type="button" class="btn w-100"
                    :disabled="!venta.articulo || !venta.articulo.divisible ? true:false"
                    :class="venta.detalleVenta.id_articulo  ?  'btn-info':'btn-secondary'" @click="addToList">Agregar a la lista</button>
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
            <tr v-for="(detalle,index) in venta.attributes.detalles_venta">
                <td>
                    <a href="javascript:void(0)"
                       @click="removeDetalleVenta(index)"
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
                    @{{ venta.totalDetallesVenta}}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


