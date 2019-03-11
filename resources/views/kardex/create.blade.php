<form @submit.prevent="submitFormKardex">
    <div class="input-group pb-3">
        <div class="col-lg-3">
            <select class="custom-select" id="selectCargo"
                    v-model="kardex.attributes.id_cargo"
                    name="cbxCargo">
                <option :value="null" selected disabled>
                    Seleccione un cargo...
                </option>
                <option v-for="_cargo in cargo.data" :value="_cargo.id_cargo">
                    @{{ _cargo.nombre }}
                </option>
            </select>
        </div>
        <div class="col-lg-3">
            <input type="text"
                   class="form-control"
                   id="txtObservacion"
                   v-model.number="kardex.attributes.salario"
                   placeholder="Salario" name="txtSalario">
        </div>
        <div class="col-lg-3">
            <input type="date"
                   class="form-control"
                   id="txtObservacion"
                   v-model="kardex.attributes.fecha_inicio"
                   placeholder="Fecha de inicio" name="txtFechaInicio">
        </div>
        <div class="col-lg-3">
            <div v-if="!kardex.attributes.id_kardex">
                <button class="btn btn-primary w-100">Registrar</button>
            </div>
            <div v-else>
                <button class="btn btn-primary w-100">Actualizar</button>
                <button type="button" class="btn btn-outline-secondary w-100" @click="cancelEditKardex">Cancelar</button>
            </div>
        </div>
    </div>
</form>