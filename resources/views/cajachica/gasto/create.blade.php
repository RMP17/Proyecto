<form autocomplete="off">
    <div class="form-group row">
        <label for="txtMonto" class="col-sm-3 text-right control-label col-form-label">Monto: </label>
        <div class="col-sm-7">
            <input type="text" class="form-control" id="txtMonto" placeholder="00.00" name="txtMonto"
                   @keypress="numberFloatDirective">
        </div>
    </div>
    <div>
        <div class="form-group row">
            <label for="txtDescripcion" class="col-sm-3 text-right control-label col-form-label">Descripcion
                : </label>
            <div class="col-sm-7">
                <input type="text" class="form-control" id="txtDescripcion" placeholder=""
                       name="txtDescripcion">
            </div>
        </div>
    </div>
    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary"
                onclick="return confirm('¿Está seguro de registrar el gasto?. (Los cambios son definitivos)');">
            Realizar Gasto
        </button>
    </div>
</form>