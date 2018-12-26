<html>
	<head> <link rel="icon" type="image/png" sizes="16x16" href="{{asset('assets/images/favicon.png')}}"> </head>
	<body>
		<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-delete-almacen-{{$a->id_almacen}}">
			{{Form::Open(array('action' => array ('AlmacenControlador@destroy', $a->id_almacen), 'method' => 'delete'))}}
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title"> Eliminar Almacen </h4>
							<button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
								<span aria-hideen="true"> <i class="mdi mdi-close"></i> </span>
							</button>
						</div>
						<div class="modal-body">	
							<input type="hidden" id="txtIdSucursal" name="txtIdSucursal" value="{{$id_sucursal}}">
							<p> ¿Desea eliminar el registro de este almacen? </p>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary"> Confirmar </button>
							<button type="button" class="btn btn-danger" data-dismiss="modal"> Cerrar </button>
						</div>		
					</div>
				</div>
			{{Form::Close()}}
		<div>
	<body>
</html>