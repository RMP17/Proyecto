<div class="input-group">
    <div class="input-group-prepend">
        <label for="txtMontoApertura" class="input-group-text">Monto de apertura : </label>
    </div>
    <input type="text" class="form-control" id="txtMontoApertura" placeholder="00.00"
           name="txtMontoApertura" onkeypress="return ValidarDecimalTecleado(event, this.id)">
    <button class="btn btn-outline-primary">Aperturar</button>
</div>