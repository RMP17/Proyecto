@include('kardex.kardex_observaciones.create')

<div class="d-flex flex-wrap justify-content-center">
    <div class="m-1">
        <button class="btn btn-primary" @click="changePermisos(1)" style="width: 132px">
            Seleccionar todo
        </button>
    </div>
    <div class="m-1">
        <button class="btn btn-primary" @click="changePermisos(0)" style="width: 132px">
            Deseleccionar
        </button>
    </div>
	<div v-for="(permiso, index) in acceso.permisos" class="m-1"
		 style="padding: 0.3rem;border: 1px solid darkgray;border-radius: 5px;">
		<div class="custom-control custom-checkbox" style="width: 120px;">
			<input type="checkbox"
                   v-model="permiso.permitir"
                   true-value=1
                   false-value=0
                   class="custom-control-input"
                   :id="index+'customCheck1'" number>
			<label class="custom-control-label" :for="index+'customCheck1'"
				   style="padding-top: 2px;">@{{ permiso.descripcion}}</label>
		</div>
	</div>
</div>