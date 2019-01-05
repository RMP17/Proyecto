<a href data-target="#modal-registro-proveedor" data-toggle="modal"
   title="Nueva Moneda">
    <button type="button" class="btn btn-outline-success btn-sm"><i class="fas fa-user"></i></button>
</a>

<div class="table-responsive">
    <table class="table table-striped table-sm table-bordered">
        <thead>
        <tr>
            <th>Razón Social</th>
            <th>NIT / CI</th>
            <th>Ciudad</th>
            <th>Teléfono</th>
            <th>Celular</th>
            <th>Correo</th>
            <th>Sitio Web</th>
            <th>Dirección</th>
            <th>Registrado en fecha</th>
            <th>Rubro</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        {{--@foreach($proveedores as $p)
           <tr>
               <td>{{ $p -> razon_social }}</td>
               <td>{{ $p -> nit }}</td>
               <td>{{ $p -> id_ciudad }}</td>
               <td>{{ $p -> telefono }}</td>
               <td>{{ $p -> celular }}</td>
               <td>{{ $p -> correo }}</td>
               <td>{{ $p -> sitio_web}}</td>
               <td>{{ $p -> direccion }}</td>
               <td>{{ $p -> fecha_registro }}</td>
               <td>{{ $p -> rubro }}</td>
               <td>
                   <a href="{{URL::action('ProveedorControlador@edit', $p -> id_proveedor)}}"><button type="button" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></button></a>
                   <a href="" data-target="#modal-delete-{{$p->id_proveedor}}" data-toggle="modal" type="submit" > <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button></a>
                   <a title="Agregar cuenta bancaria" href="{{URL::action('CuentaProveedorControlador@show',$p->id_proveedor)}}" type="submit" class="btn btn-primary btn-sm"><i class="fab fa-cc-visa"></i></a>
               </td>
           </tr>
       @endforeach--}}
        </tbody>
    </table>
</div>
{{--===============================================Modal Articulos======================================--}}
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-registro-proveedor">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title pt-1 pr-1">Nuevo Proveedor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
                </button>
            </div>
            <div class="modal-body pb-0">
                @include('proveedor.create')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar</button>
            </div>
        </div>
    </div>
</div>