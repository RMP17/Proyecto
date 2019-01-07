<div class="d-flex bd-highlight">
    <div class="mr-auto">
        <a href data-target="#modal-new-contact" data-toggle="modal"
           title="Nuevo Contacto" class="btn btn-outline-success btn-sm-icon">
            <i class="far fa-address-card fa-2x"></i>
        </a>
    </div>
    <div>
        <a href data-target="#modal-registro-proveedor" data-toggle="modal"
           title="Nueva Moneda">
            <button type="button" class="btn btn-outline-success btn-sm"><i class="fas fa-user"></i></button>
        </a>
    </div>
</div>
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
            <th>Proveedor</th>
            <th>Cargo</th>
            <th>Estado</th>
            <th>Acctiones</th>
        </tr>
        </thead>
        <tbody>
        {{--@foreach($contactos as $c)
           <tr>
               <td>{{ $c -> nombre }}</td>
               <td>{{ $c -> telefono }}</td>
               <td>{{ $c -> interno }}</td>
               <td>{{ $c -> celular }}</td>
               <td>{{ $c -> correo }}</td>
               <td>{{ $c -> fecha_registro }}</td>
               <td>{{ $c -> estado }}</td>
               <td>{{ $c -> id_proveedor }}</td>
               <td>{{ $c -> id_cargo }}</td>

                @if($c->estatus=='A')
                <td> <span class="waves-effect waves-light btn btn-primary btn-sm">Activo</span> </td>
                @else
                 @if($c->estatus=='X')
                <td ><span class="waves-effect waves-light btn btn-default btn-sm" style="background: red">Baja</span> </td>
                @endif
                @endif
               <td>
                   <a href="{{URL::action('ContactoControlador@edit', $c -> id_contacto)}}"><button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button></a>
                    <a href="" data-target="#modal-delete-{{$c -> id_contacto}}" data-toggle="modal"><button type="button" class="btn btn-danger btn-sm"><i <i class="mdi mdi-thumb-down"></i></button></a>
               </td>
           </tr>
       @endforeach--}}
        </tbody>
    </table>
</div>
{{--===============================================Modal New Contact======================================--}}
<div class="modal fade modal-slide-in-right"
     @keydown.esc_x="cancelModeEditProveedor"
     aria-hidden="true" role="dialog" tabindex="-1" id="modal-new-contact">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Nuevo Contacto</h4>
                <button type="button" class="close"
                        @click_x="cancelModeEditProveedor"
                        data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                @include('contacto.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger"
                        data-dismiss="modal" @click_x="cancelModeEditProveedor" > Cerrar</button>
            </div>
        </div>
    </div>
</div>
