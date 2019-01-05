<form @submit.prevent="submitFormPais">
    <div class="form-row">
        <div class="col-md-10">
            <input type="text" class="form-control" v-model="pais.attributes.nombre" id="txtNombre" placeholder="Nombre del país que desea registrar"
                   name="nombre">
        </div>
        <div class="col-md-2 pb-2">
            <button v-if="!pais.attributes.id_pais" type="submit" class="btn btn-primary w-100"> Registrar </button>
            <button v-else type="submit" class="btn btn-primary w-100"> Actualizar </button>
        </div>
    </div>
</form>