<div class="container-fluid">
    {!!Form::open(array('class' => 'form-horizontal', 'url' => 'articulo', 'method' => 'POST', 'autocomplete' => 'off'))!!}
    {{Form::token()}}
    <div class="card-group mb-0">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Datos de registro del artículo</h4>
                <div class="form-group row mb-2">
                    <label for="txtNombre" class="col-sm-3 text-right control-label col-form-label">
                        Artículo:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control"
                               id="txtNombre"
                               v-model="articulo.attributes.nombre"
                               placeholder="El nombre del artículo va aquí" name="nombre">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="txtCodigo" class="col-sm-3 text-right control-label col-form-label">
                        Código:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control"
                               id="txtCodigo"
                               v-model="articulo.attributes.codigo"
                               placeholder="El código del artículo que lo identifique va aquí" name="txtCodigo">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="txtCodigoBarra" class="col-sm-3 text-right control-label col-form-label">
                        Código de Barra:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control"
                               id="txtCodigoBarra"
                               v-model="articulo.attributes.codigo_barra"
                               placeholder="La serie del código de barras va aquí" name="txtCodigoBarra">
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="txtCaracteristicas" class="col-sm-3 text-right control-label col-form-label">
                        Características:</label>
                    <div class="col-sm-9">
                                <textarea rows="2" wrap="soft" class="form-control"
                                          id="txtCaracteristicas"
                                          v-model="articulo.attributes.caracteristicas"
                                          placeholder="Escriba algunas características relevantes del artículo"
                                          name="txtCaracteristicas"></textarea>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="imgImagen" class="col-sm-3 text-right control-label col-form-label">
                        Imagen:</label>
                    <div class="col-sm-9">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="imgImagen" accept="image/jpeg">
                            <label class="custom-file-label" for="validatedCustomFile">Carga una imagen del artículo en
                                formato .jpeg aquí</label>
                            <div class="invalid-feedback">Archivo inválido</div>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="cbxCategoria" class="col-sm-3 text-right control-label col-form-label">
                        Categoría :</label>
                    <div class="col-sm-9">
                        {{--<select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                                id="cbxCategoria" name="cbxCategoria">
                            <option></option>
                        </select>--}}
                        <input type="text" class="custom-select" name="city" list="categoriasNames"
                               @change="filter($event)">
                        <datalist id="categoriasNames">
                            <option value="---">
                            <option v-for="categoria in categoria.allData" :value="categoria.categoria">
                        </datalist>
                    </div>
                </div>
                {{--  <div class="form-group row mb-2">
                      <label for="cbxSubcategoria" class="col-sm-3 text-right control-label col-form-label">
                          Subcategoria:</label>
                      <div class="col-sm-9">
                          <select class="select2 form-control custom-select" style="width: 100%; height:36px;"
                                  id="cbxSubcategoria" name="cbxSubcategoria">
                                  <option></option>
                          </select>
                      </div>
                  </div>--}}
                <div class="form-group row mb-2">
                    <label for="cbxFabricante" class="col-sm-3 text-right control-label col-form-label">
                        Fabricante:</label>
                    <div class="col-sm-9">
                        <input type="text" class="custom-select" name="city" list="FabricantesNames"
                               @change="filter($event)">
                        <datalist id="FabricantesNames">
                            <option value="---">
                            <option v-for="fabricante in fabricante.allData" :value="fabricante.nombre">
                        </datalist>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="rbtDivisible" class="col-sm-3 text-right control-label col-form-label">
                        Divisible?:</label>
                    <div class="col-sm-9 form-control border-0">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="rbtDivisible0"
                                   name="rbtDivisible" required
                                   :value=1
                                   v-model="articulo.attributes.divisible">
                            <label class="custom-control-label" for="rbtDivisible0">Si</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="rbtDivisible1"
                                   name="rbtDivisible" required checked
                                   :value=0
                                   v-model="articulo.attributes.divisible">
                            <label class="custom-control-label" for="rbtDivisible1">No</label>
                        </div>
                    </div>
                </div>
                {{--<div class="form-group row mb-2">
                    <label for="rbtDimensionable"
                           class="col-sm-3 text-right control-label col-form-label">¿Desea guardar dimensiones?</label>
                    <div class="col-sm-9 form-control border-0">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="rbtDimensionable0"
                                   name="rbtDimensionable" required value=1 onchange="habilitar_dimensiones(1)">
                            <label class="custom-control-label" for="rbtDimensionable0">Si</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" id="rbtDimensionable1"
                                   name="rbtDimensionable" required checked value=0
                                   onchange="habilitar_dimensiones(0)">
                            <label class="custom-control-label" for="rbtDimensionable1">No</label>
                        </div>
                    </div>
                </div>--}}
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Dimensiones del artículo (Unidades en centímetros)</h4>
                <fieldset :disabled="!articulo.attributes.divisible">
                    <div class="form-group row mb-2">
                        <label for="txtLargo"
                               class="col-sm-4 text-right control-label col-form-label">Largo:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtLargo" placeholder="00.00"
                                   name="txtLargo"
                                   v-model="articulo.attributes.dimensiones.largo"
                                   onkeypress="return ValidarDecimalTecleado(event, this.id)"
                                   onblur="ValidarDecimalPegado(event, this.id)">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="txtAncho"
                               class="col-sm-4 text-right control-label col-form-label">Ancho:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtAncho" placeholder="00.00"
                                   name="txtAncho"
                                   onkeypress="return ValidarDecimalTecleado(event, this.id)"
                                   onblur="ValidarDecimalPegado(event, this.id)">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="txtEspesor"
                               class="col-sm-4 text-right control-label col-form-label">Espesor:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtEspesor" placeholder="00.00"
                                   name="txtEspesor"
                                   onkeypress="return ValidarDecimalTecleado(event, this.id)"
                                   onblur="ValidarDecimalPegado(event, this.id)">
                        </div>
                    </div>
                    <div class="form-group row mb-2">
                        <label for="txtVolumen"
                               class="col-sm-4 text-right control-label col-form-label">Volumen:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="txtVolumen" placeholder="00.00"
                                   name="txtVolumen"
                                   onkeypress="return ValidarDecimalTecleado(event, this.id)"
                                   onblur="ValidarDecimalPegado(event, this.id)">
                        </div>
                    </div>
                </fieldset>

                <h4 class="card-title">Precio de compra y venta de producción del artículo (Bs.)</h4>
                <div class="form-group row mb-2">
                    <label for="txtPrecioCompra"
                           class="col-sm-4 text-right control-label col-form-label">Precio de Compra:</label>
                    <div class="col-sm-8">
                        <label class="sr-only" for="inlineFormInputGroup">Username</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="txtPrecioCompra" placeholder="00.00"
                                   name="txtPrecioCompra"
                                   onkeypress="return ValidarDecimalTecleado(event, this.id)"
                                   onblur="ValidarDecimalPegado(event, this.id)">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">Bs.</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb-2">
                    <label for="txtPrecioProduccion"
                           class="col-sm-4 text-right control-label col-form-label">Precio de venta
                        (producción):</label>
                    <div class="col-sm-8">
                        <div class="input-group mt-2">
                            <input type="text" class="form-control" id="txtPrecioProduccion" placeholder="00.00"
                                   name="txtPrecioProduccion"
                                   onkeypress="return ValidarDecimalTecleado(event, this.id)"
                                   onblur="ValidarDecimalPegado(event, this.id)">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2">Bs.</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card border-top border-bottom border-right">
        <div class="card-body text-center m-0 p-0">
            <button type="submit" class="btn btn-primary">Registrar</button>
            <button type="reset" class="btn btn-danger">Cancelar</button>
        </div>
    </div>
    {!!Form::close()!!}
</div>
