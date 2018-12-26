<div class="container-fluid">
    <div v-if="categoria.errors.length > 0" class="alert alert-danger" role="alert">
        <li v-for="error in categoria.errors"> @{{error}}</li>
    </div>

    <form class="form-horizontal" @submit.prevent="submitFormCategoria">
        <div class="form-group row">
            <label for="txtCategoria" class="col-sm-3 text-right control-label col-form-label">Nueva categoría
                : </label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="txtCategoria" v-model="categoria.attributes.categoria"
                       placeholder="Nombre de la categoría que desea registrar" name="txtCategoria">
            </div>
        </div>
        <div class="form-group row">
            <label for="txtDescripcion" class="col-sm-3 text-right control-label col-form-label">Descripción
                : </label>
            <div class="col-sm-9">
                        <textarea rows="5" wrap="soft" class="form-control" id="txtDescripcion"
                                  placeholder="Escriba una breve descripción de la categoría aquí"
                                  name="txtDescripcion"
                                  v-model="categoria.attributes.descripcion"
                        ></textarea>
            </div>
        </div>
        <div v-if="!categoria.modeEdit" class="form-group text-center">
            <button class="btn btn-primary w-25" type="submit">Registrar</button>
        </div>
        <div v-else class="form-group text-center">
            <button class="btn btn-primary w-25" type="submit">Actualizar</button>
            <button type="button" class="btn btn-warning w-25" @click="cancelEditModeCategoria">Cancelar</button>
        </div>
    </form>

</div>