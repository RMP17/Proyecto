<div v-if="produccion.oneProduccion" class="section-to-print" ref="print_produccion_etiqueta">
    <div id="print-section ">
        <h5 class="text-center">Etiqueta</h5>
        <p class="text-center"><strong>CLIENTE : @{{ produccion.oneProduccion.cliente.razon_social }}</strong></p>
        <p class="text-center"><strong>CÓDIGO : @{{ produccion.oneProduccion.id_produccion }}</strong></p>
    </div>
</div>