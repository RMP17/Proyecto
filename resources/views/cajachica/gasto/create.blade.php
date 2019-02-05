<form autocomplete="off" @submit.prevent="submitFormGasto">
    <div class="form-group row">
        <label for="txtMonto" class="col-sm-3 text-right control-label col-form-label">Monto: </label>
        <div class="col-sm-7">
            <input type="text"
                   class="form-control"
                   v-model.number="caja.gasto.attributes.monto"
                   id="txtMonto" placeholder="00.00" name="txtMonto"
                   @keypress="numberFloatDirective">
        </div>
    </div>
    <div>
        <div class="form-group row">
            <label for="txtDescripcion" class="col-sm-3 text-right control-label col-form-label">Descripcion
                : </label>
            <div class="col-sm-5">
                <input type="text"
                       class="form-control"
                       v-model="caja.gasto.attributes.descripcion"
                       id="txtDescripcion" placeholder=""
                       name="txtDescripcion">
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"
                        onclick="return confirm('¿Está seguro de registrar el gasto?. (Los cambios son definitivos)');">
                    Realizar Gasto
                </button>
            </div>
        </div>
    </div>
</form>