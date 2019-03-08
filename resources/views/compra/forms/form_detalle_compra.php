<div class="d-flex justify-content-center mb-2" v-if="!compra.hideSuggestionsArticulo">
    <div class="col-lg-4 pr-0"><input
                class="form-control"
                ref="input_articulo_codigo"
                @keydown.enter="getArticuloByCodigo($event)"
                placeholder="Código del Artículo" type="text"></div>
    <div class="col-lg-4 pr-0 pl-0"><input
                class="form-control"
                ref="input_articulo_codigo_barra"
                @keydown.enter="getArticuloByCodigoBarras($event)"
                placeholder="Código de Barras del Artículo" type="text"></div>
    <div class="col-lg-4 pl-0">
        <app-online-suggestions-objects :config="configArticulo"
                                        :input-value="compra.tempDetalleCompra.nombre"
                                        @selected-suggestion-event="assignAnIdentificationOfArticuloToDetalleCompra">
        </app-online-suggestions-objects>
    </div>
</div>
<div class="d-flex justify-content-center mb-2">
    <div class="col-lg-4 pr-0">
        <div class="form-control border border-info border-right-0 border-left-0">
            Categoria: {{ compra.articulo.categoria? compra.articulo.categoria.categoria:'' }}
        </div>
    </div>
    <div class="col-lg-4 pr-0 pl-0">
        <div class="form-control border border-info border-right-0 border-left-0">
            Fabricante: {{ compra.articulo.fabricante ? compra.articulo.fabricante.nombre:'' }}
        </div>
    </div>
    <div class="col-lg-4 pl-0">
        <div class="form-control border border-info border-right-0 border-left-0"
             title="Stock del almacen que se te asigno ">
            Stock: {{ compra.articulo.stock }}
        </div>
    </div>
</div>
<div class="d-flex justify-content-center mb-4">
    <div class="col-lg-4 pr-0"><input
                class="form-control"
                ref="txtCantidad"
                v-model.number ="compra.detalleCompra.cantidad"
                placeholder="Cantidad" type="text" @keypress="numberPositiveDirective"></div>
    <div class="col-lg-4 pr-0 pl-0"><input
                @keypress.enter="addDetalleCompra"
                class="form-control"
                v-model.number="compra.detalleCompra.precio_unitario"
                placeholder="Precio Unitario" type="text" @keypress="numberFloatDirective"></div>
    <div class="col-lg-4 pl-0">
        <button type="button" class="btn w-100" :class="compra.detalleCompra.id_articulo ?  'btn-info':'btn-secondary'" @click="addDetalleCompra">Agregar a la lista</button>
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
            <tr v-for="(detalle,index) in compra.attributes.detalles_compra">
                <td>
                    <a href="javascript:void(0)"
                       @click="removeDetalleCompra(index)"
                       class="text-danger" title="Quitar"><i class="fas fa-minus fa-lg"></i></a>
                    {{ detalle.nombre}}
                </td>
                <td class="text-right pr-3">{{ detalle.cantidad}}</td>
                <td class="text-right pr-3">{{ detalle.precio_unitario}}</td>
                <td class="text-right pr-3">{{ detalle.subtotal}}</td>
            </tr>
            <tr>
                <th>TOTAL</th>
                <td colspan="3" class="text-right pr-3">
                    {{ compra.totalDetallesCompra}}
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


