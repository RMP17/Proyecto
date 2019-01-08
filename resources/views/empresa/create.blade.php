<form @submit.prevent="submitFormEmpresa">
    <div class="form-group row mb-2">
        <label for="txtRazon_social" class="col-sm-3 text-right control-label col-form-label">Razón
            Social: </label>
        <div class="col-sm-8">
            <input type="text" class="form-control"
                   id="txtRazon_social"
                   v-model="empresa.attributes.razon_social"
                   placeholder="El nombre o razón sicial de la empresa aquí" name="txtRazon_social">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtNit" class="col-sm-3 text-right control-label col-form-label">NIT : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control"
                   id="txtNit" placeholder="El NIT de la empresa aquí"
                   v-model="empresa.attributes.nit"
                   name="txtNit">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtPropietario" class="col-sm-3 text-right control-label col-form-label">Propietario
            : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="txtPropietario"
                   v-model="empresa.attributes.propietario"
                   placeholder="El nombre ddel propietario de la empresa aquí" name="txtPropietario">
        </div>
    </div>
    <div class="form-group row mb-2">
        <label for="txtActividad" class="col-sm-3 text-right control-label col-form-label">Actividad
            : </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="txtActividad"
                   placeholder="Describa la actividad o actividades de la empresa aquí"
                   v-model="empresa.attributes.actividad"
                   name="txtActividad">
        </div>
    </div>
    <div class="form-group text-center">
        <button v-if="!empresa.attributes.id_empresa" type="submit" class="btn btn-primary w-25">Registrar
        </button>
        <div v-else>
            <button type="submit" class="btn btn-primary w-25">Actualizaar</button>
            <button type="button" class="btn btn-warning w-25" @click="cancelModeEditEmpresa">Cancelar</button>
        </div>
    </div>
</form>

