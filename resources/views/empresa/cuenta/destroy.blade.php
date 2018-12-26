
<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-{{$c->id_cuenta}}">
	{{Form::Open(array('action'=>array('CuentaControlador@destroy', $c->id_cuenta),'method'=>'delete'))}}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Eliminar Cuenta Bancaria</h4>
				<button type="button" class="close col-1" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true"><i class="mdi mdi-close"></span>	
				</button>
		    </div>
			<div class="modal-body">
				<p>Confirme si desea Eliminar la cuenta bancaria</p> 
			</div>
			<input type="hidden" class="form-control" id="cbxEmpresa" placeholder="" name="cbxEmpresa" value="{{$id_empresa}}">
			<div class="modal-footer"> 
				<button type="button" class="btn btn-default" data-dismiss="modal" aria-label="close">
					<span aria-hidden="true">Cancelar</span>	
				</button>
				<button type="submit" class="btn btn-primary">Aceptar</button>
			</div>
		</div>	
	</div>
	{{Form::Close()}}
</div>