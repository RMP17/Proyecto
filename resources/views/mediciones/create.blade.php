<div class="form-group col mb-2">
    <input type="datetime-local"
           class="form-control"
           title="Fecha y hora de visita"
           v-model="medicion.attributes.fecha_visita"
           id="dtFechaVisista">
</div>
<div class="form-group col mb-2">
    <div class="input-group">
        <input type="text" class="form-control" :class="medicion.attributes.id_cliente ? 'border-success':''"
               id="txtNit"
               @keydown.enter="getClienteByNit"
               ref="txtNit"
               placeholder="Nit o Ci" name="nit" autocomplete="off">
        <div class="input-group-prepend">
            <a href="javascript:void(0)"
               title="Nuevo Cliente"
               data-backdrop="static"
               data-keyboad="false"
               data-target="#modal-new-client"
               data-toggle="modal"
               class="btn btn-outline-success"
            ><i class="fas fa-plus"></i>
            </a>
        </div>
    </div>
</div>
<div class="form-group col mb-2">
    <app-online-suggestions-objects :config="configCliente"
                                    :input-value="medicion.cliente.attributes.razon_social"
                                    @selected-suggestion-event="selectCliente">
    </app-online-suggestions-objects>
</div>
<div class="form-group col mb-2">
    <input type="text"
           class="form-control"
           title="Dirección"
           placeholder="Dirección"
           v-model="medicion.attributes.direccion"
           id="txtDireccion">
</div>
<div class="form-group col mb-2">
    <input type="text"
           class="form-control"
           title="Descripción de la dirección"
           placeholder="Descripción de la dirección"
           v-model="medicion.attributes.descripcion_direccion"
           id="txtDescripcionDireccion">
</div>
<div class="form-group col mb-2">
    <textarea type="text"
              class="form-control"
              rows="2"
              placeholder="Observaciones"
              v-model="medicion.attributes.observaciones"
              id="txtObservacion"></textarea>
</div>
<div class="form-group col mb-2">
    <button type="button" class="btn btn-info w-100" {{--@click="submitFormMovimiento"--}}>Registrar</button>
</div>
