{{--<div class="d-flex bd-highlight">
    <div style="width: 15rem">
        <app-online-suggestions-objects v-if="!contacto.hideSuggestions" :config="contacto.configProveedor"
                                        @selected-suggestion-event="getContactosDeProveedor">
        </app-online-suggestions-objects>
    </div>
</div>--}}
<div class="table-responsive">
    <table class="table table-striped table-bordered table-sm">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Teléfono</th>
            <th>Teléfono interno</th>
            <th>Celular</th>
            <th>Correo</th>
            <th>Registrado en fecha</th>
            <th>Estado</th>
            <th>Cargo</th>
            <th>Acctiones</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="_contacto in contacto.data">
            <td>@{{ _contacto.nombre }}</td>
            <td>@{{ _contacto.telefono }}</td>
            <td>@{{ _contacto.interno }}</td>
            <td>@{{ _contacto.celular }}</td>
            <td>@{{ _contacto.correo }}</td>
            <td>@{{ _contacto.fecha_registro }}</td>
            <td>@{{ _contacto.estado }}</td>
            <td>@{{ _contacto.cargo ? _contacto.cargo.nombre: '' }}</td>
            <td>
                <a href="javascript:void(0)"
                   title="Editar"
                   @click="changeModeEditContactoProveedor(_contacto)"
                   type="button" class="btn btn-warning btn-sm">
                    <i class="mdi mdi-pencil"></i>
                </a>
            </td>
        </tr>
        </tbody>
    </table>
</div>
{{--===============================================Modal New Contact======================================--}}
<div class="modal fade modal-slide-in-right"
     aria-hidden="true" role="dialog" tabindex="-1" id="modal-new-contact">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Nuevo Contacto</h4>
                <button type="button" class="close"
                        data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                @include('contacto.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                        data-dismiss="modal" > Cerrar</button>
            </div>
        </div>
    </div>
</div>
{{--===============================================Modal Edit Contact======================================--}}
<div class="modal fade modal-slide-in-right"
     @keydown.esc="cancelModeEditContacto"
     aria-hidden="true" role="dialog" tabindex="-1" id="modal-edit-contacto">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Editar Contacto</h4>
                <button type="button" class="close"
                        @click="cancelModeEditContacto"
                        data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                @include('contacto.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                        data-dismiss="modal" @click="cancelModeEditContacto" > Cerrar</button>
            </div>
        </div>
    </div>
</div>
