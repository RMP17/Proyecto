<div class="row">
	<div class="col-12">
		<div class="form-group row my-1 float-right">
			<label class="mr-sm-2 mt-2" for="inlineFormCustomSelect">Página</label>
			<div class="col-sm-2">
				<select @change="getCategorias($event.target.value)" class="custom-select mr-sm-2" id="inlineFormCustomSelect" style="width: 100px">
					{{--<option selected></option>--}}
					<option v-for="page in pagesNumberCategoria" :selected="categoria.pagination.current_page==page" >@{{ page }}</option>
				</select>
				{{--<select class="custom-select mr-sm-2" id="inlineFormCustomSelect" style="width: 100px">
					--}}{{--<option selected></option>--}}{{--
					<option>-</option>
					<option v-for="categoria in categoria.allData">@{{ categoria.categoria }}</option>
				</select>--}}
			</div>
		</div>
		<table class="table table-sm mb-0">
			<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Nombre</th>
				<th scope="col">Descripción</th>
				<th scope="col">Acciones</th>
			</tr>
			</thead>
			<tbody>
			<tr v-for="(categoria, index) in categoria.data">

				<th scope="row">@{{index + 1 }}</th>
				<td>@{{ categoria.categoria }}</td>
				<td>@{{ categoria.descripcion }}</td>
				<td>
					<a title="Editar" href="#" type="button" class="btn btn-warning btn-sm"
					   @click="changeToEditModeCategoria(categoria)"
					>
						<i class="mdi mdi-pencil"></i>
					</a>
					<a title="Eliminar" href="#" type="button" class="btn btn-danger btn-sm"
                       @click="deleteCategorias(categoria.id_categoria, index)">
						<i class="mdi mdi-delete-forever"></i>
					</a>
					{{--
                    <a href="{{URL::action('SubcategoriaControlador@show', $c -> id_categoria)}}">
                        <button type="button" class="btn btn-dark btn-sm"><i class="mdi mdi-plus-circle"></i>
                        </button>
                    </a>
                   	--}}
				</td>
			</tr>
			</tbody>
		</table>
		{{--{{$categorias-> render()}}--}}
	</div>
	{{--@include ('categoria.create')--}}
</div>
		{{--<script src="{{asset('assets/extra-libs/multicheck/datatable-checkbox-init.js')}}"></script>
		<script src="{{asset('assets/extra-libs/multicheck/jquery.multicheck.js')}}"></script>
		<script src="{{asset('assets/extra-libs/DataTables/datatables.min.js')}}"></script>
		<script>
			/****************************************
			 *       Basic Table                   *
			 ****************************************/
			$('#zero_config').DataTable();
		</script>--}}