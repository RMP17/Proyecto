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
<div class="form-group col mb-2" v-if="!medicion.cliente.oneCliente">
    <app-online-suggestions-objects :config="configCliente"
                                    @selected-suggestion-event="selectCliente">
    </app-online-suggestions-objects>
</div>
<div class="form-group col mb-2" v-else>
    <app-online-suggestions-objects :config="configCliente"
                                    :input-value="medicion.cliente.oneCliente.razon_social"
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
    <button type="button" class="btn btn-info w-100" @click="submitFormMedicion">Registrar</button>
</div>


{{--===============================================Modal New Client======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1"
     id="modal-new-client">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Nuevo Cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                @include('mediciones.cliente.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Cerrar
                </button>
            </div>
        </div>
    </div>
</div>