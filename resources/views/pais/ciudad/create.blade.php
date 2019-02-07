<form @submit.prevent="submitFormCiudad">
    <div class="input-group pb-3">
        <input type="text" placeholder="Nombre de la Ciudad"
               class="form-control" v-model="pais.ciudad.attributes.nombre">
        <div class="input-group-append">
            <button v-if="!pais.ciudad.attributes.id_pais" type="submit" class="btn btn-primary">Registrar</button>
            <div v-else>
                <button type="submit" class="btn btn-primary">Actualizaar</button>
                <button type="button" class="btn btn-warning" @click="cancelModeEditCiudad">Cancelar</button>
            </div>
        </div>
    </div>
</form>
