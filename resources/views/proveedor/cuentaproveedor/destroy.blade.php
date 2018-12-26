<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$c->id_cuenta}}">
	{{Form::Open(array('action'=>array('CuentaProveedorControlador@destroy', $c->id_cuenta),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Eliminar Cuenta Bancaria</h4>
				<button type="button" class="close col-1" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true"><i class="mdi mdi-close"></i></span>	
				</button>
		    </div>
			<div class="modal-body">
				<p>Confirme si desea eliminar esta cuenta bancaria</p> 
			</div>
			<input type="hidden" class="form-control" id="cbxProveedor" placeholder="" name="cbxProveedor" value="{{$id_proveedor}}">
			<div class="modal-footer"> 
				<button type="submit" class="btn btn-primary">Aceptar</button>
				<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">Cancelar</span>	
				</button>
			</div>
		</div>	
	</div>
	{{Form::Close()}}
</div>