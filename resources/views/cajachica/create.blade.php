<div v-if="caja.oneCaja && caja.oneCaja.status!=='a'">
    <form @submit.prevent="closedAndOpenCashier" autocomplete="off">
        <div class="form-group">
            <input type="text" class="form-control" id="txtMontoApertura"
                   v-model.number="caja.caja_chica.monto"
                   placeholder="Monto de apertura"
                   name="txtMontoApertura" @keypress="numberFloatDirective">
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-primary">Aperturar</button>
        </div>
    </form>
</div>
<div v-else>
    <form @submit.prevent="closedAndOpenCashier" autocomplete="off">
        <div class="form-group">
            <input type="text" class="form-control" id="txtMontoApertura"
                   v-model.number="caja.caja_chica.monto"
                   placeholder="Monto de declarado"
                   name="txtMontoApertura" @keypress="numberFloatDirective">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="txtObservaciones"
                   v-model.number="caja.caja_chica.diferencia"
                   placeholder="Diferencia"
                   name="txtDiferencia">
        </div>
        <div class="form-group">
            <input type="text" class="form-control" id="txtObservaciones"
                   v-model="caja.caja_chica.observaciones"
                   placeholder="Observaciones"
                   name="txtObservaciones">
        </div>
        <div class="form-group text-center">
            <button type="submit" class="btn btn-outline-primary">Cerrar Caja</button>
        </div>
    </form>
</div>