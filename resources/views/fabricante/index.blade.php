<div class="container-fluid">
    <div class="col-12">
        <div class="form-group row my-1 float-right">
            <label class="mr-sm-2 mt-2" for="inlineFormCustomSelect">Página</label>
            <div class="col-sm-2">
                <select @change="getFabricantes($event.target.value)" class="custom-select mr-sm-2" id="inlineFormCustomSelect" style="width: 100px">
                    {{--<option selected></option>--}}
                    <option v-for="page in pagesNumberFabricante" :selected="fabricante.pagination.current_page==page" >@{{ page }}</option>
                </select>
            </div>
        </div>
        <table class="table table-sm mb-0">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Contacto</th>
                <th scope="col">Sitio Web</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>

            <tr v-for="(fabricante, index) in fabricante.data">
                        <th scope="row">@{{index+1}}</th>
                        <td>@{{ fabricante.nombre }}</td>
                        <td>@{{ fabricante.contacto }}</td>
                        <td>@{{ fabricante.sitio_web}}</td>
                        <td>
                            <a title="Editar" href="#" type="button" class="btn btn-warning btn-sm"
                               @click="changeToEditModeFabricante(fabricante)"
                            ><i class="mdi mdi-pencil"></i>
                            </a>
                            <a title="Eliminar" href="#" type="button" class="btn btn-danger btn-sm"
                               @click="deleteFabricante(fabricante.id_fabricante, index)">
                                <i class="mdi mdi-delete-forever"></i>
                            </a>
                        </td>
                    </tr>
            </tbody>
        </table>
    </div>

    {{--@include ('fabricante.create')--}}
</div>