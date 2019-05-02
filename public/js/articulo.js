var appArticulo = new Vue({
    el: '#app-articulo',
    data: {
        //========= categorias =========
        categorias:[],
        fabricantes:[],
        sucursales:[],
        categoria: {
            modeCreate: false,
            modeEdit: false,
            errors: [],
            pagination: {
                total: 0,
                per_page: 1,
                last_page: 1,
                from: 1,
                to: 0,
                current_page: 1
            },
            data: [],
            attributes: {
                id_categoria:null,
                categoria: '',
                descripcion: '',
            },
            tempAttributes: {
                id_categoria:null,
                categoria: '',
                descripcion: '',
            }



        },
        fabricante: {
            modeCreate: false,
            modeEdit: false,
            errors: [],
            pagination: {
                total: 0,
                per_page: 1,
                last_page: 1,
                from: 1,
                to: 0,
                current_page: 1
            },
            data: [],
            attributes: {
                id_fabricante:null,
                nombre: '',
                contacto: '',
                sitio_web: '',
            },
            tempAttributes: {
                id_fabricante:null,
                nombre: '',
                contacto: '',
                sitio_web: '',
            }

        },
        articulo:{
            config:{
                url:urlGlobal.getArticuloForName,
                placeholder:'Nombre del Artículo',
                variableForSuggestions:'nombre',
                variableForSuggestionsId:'id_articulo'
            },
            modeCreate:false,
            modeEdit:false,
            errors: [],
            data: [],
            oneArticulo:null,
            stock:{
                data:[],
            },
            attributes: {
                id_articulo:null,
                nombre: '',
                codigo: '',
                codigo_barra:'',
                caracteristicas:'',
                precio_compra:null,
                precio_produccion:null,
                estatus:'',
                imagen:'',
                fecha_registro:'',
                divisible:0,
                dimensiones:{
                    largo:null,
                    ancho:null,
                    espesor:null,
                    volumen:null
                },
                id_fabricante:null,
                id_categoria:null
            },
            tempAttributes:{
                id_articulo:null,
                nombre: '',
                codigo: '',
                codigo_barra:'',
                caracteristicas:'',
                precio_compra:null,
                precio_produccion:null,
                estatus:'',
                imagen:'',
                fecha_registro:'',
                divisible:0,
                dimensiones:{
                    largo:null,
                    ancho:null,
                    espesor:null,
                    volumen:null
                },
                id_fabricante:null,
                id_categoria:null
            },
            paginated: {
                size: 15,
                pageNumber: 0,
            },
        },
        filter:{
            id_fabricante:null,
            id_categoria:null,
        },
        entradaSalidaArticulos:{
            modeEdit:false,
            modeCreate:false,
            hideSuggestions:false,
            hideFilters:false,
            data:[],
            data_with_filters:[],
            filters:{
                empleado:'',
                almacen:'',
                actividad:''
            },
            paginated:{
                pageNumber:0,
                size:10
            },
            attributes:{
                id:null,
                id_almacen:null,
                id_articulo:null,
                cantidad:null,
                // producctos que entran y salen
                // entrada=e; s=salida
                actividad:null,
                observaciones:null
            },
            model:{
                id:null,
                id_almacen:null,
                id_articulo:null,
                cantidad:null,
                // producctos que entran y salen
                // entrada=e; s=salida
                actividad:null,
                observaciones:null
            }
        },
        articulosSucursales:{
            modeEdit:false,
            modeCreate:false,
            hiddenSuggestions:false,
            attributes:{
                id_articulo:null,
                id_sucursal:null,
                precio_1:null,
                precio_2:null,
                precio_3:null,
                precio_4:null,
                precio_5:null,
            },
            articulo:null,
            precios:[],
            tempAttributes:{
                id_articulo:null,
                id_sucursal:null,
                precio_1:null,
                precio_2:null,
                precio_3:null,
                precio_4:null,
                precio_5:null,
            },
            model:{
                id_articulo:null,
                id_sucursal:null,
                precio_1:null,
                precio_2:null,
                precio_3:null,
                precio_4:null,
                precio_5:null,
            }
        },
        almacenes:[],
        configEmpleado:{
            url:urlGlobal.simpleSuggestionsEmpleados,
            placeholder:'Nombre del Empleado',
            variableForSuggestions:'nombre',
            variableForSuggestionsId:'id_empleado'
        },
    },
    mounted(){
        this.$nextTick(function () {
            this.getCategorias(1);
            this.getFabricantes(1);
            this.getAllCategorias();
            this.getSucursales();
            this.getAllFabricantes();
            this.almacenes=almacenes_php;
        });
    },
    computed: {
        pageCount: function(){
            let l = this.articulo.data.length,
                s = this.articulo.paginated.size;
            return Math.ceil(l/s);
        },
        paginatedData: function(){
            const start = this.articulo.paginated.pageNumber * this.articulo.paginated.size,
                end = start + this.articulo.paginated.size;
            return this.articulo.data.slice(start, end);
        },
        pageCountEntradasSalidas: function(){
            let l = this.entradaSalidaArticulos.data_with_filters.length,
                s = this.entradaSalidaArticulos.paginated.size;
            return Math.ceil(l/s);
        },
        paginatedDataEntradasSalidas: function(){
            const start = this.entradaSalidaArticulos.paginated.pageNumber * this.entradaSalidaArticulos.paginated.size,
                end = start + this.entradaSalidaArticulos.paginated.size;
            return this.entradaSalidaArticulos.data_with_filters.slice(start, end);
        },
        pagesNumberCategoria: function () {
            let pagesArray = [];
            let from = 1;
            while (from <= this.categoria.pagination.last_page) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
        pagesNumberFabricante: function () {
            let pagesArray = [];
            let from = 1;
            while (from <= this.fabricante.pagination.last_page) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },
    },
    methods: {
        getSucursales() {
            axios.get(urlGlobal.resourcesSucursal
            ).then(response => {
                this.sucursales = response.data;
            }).catch(errors => {
                console.log('errors');
            });
        },
        getPreciosArticulo(id_articulo) {
            axios.get(urlGlobal.getPreciosArticulo+id_articulo
            ).then(response => {
                this.articulosSucursales.precios = response.data;
            }).catch(errors => {
                console.log('errors');
            });
        },
        getAllCategorias(){
            axios.get(urlGlobal.getAllCategorias)
                .then((response)=>{
                    this.categorias=response.data;
                }).catch((errors)=>{
                console.log(errors);
            });
        },
        getAllFabricantes(){
            axios.get(urlGlobal.getAllFabricantes)
                .then((response)=>{
                    this.fabricantes=response.data;
                }).catch((errors)=>{
                console.log(errors);
            });
        },
        getArticulos(){
            axios.get(urlGlobal.getArticulos)
                .then((response)=>{
                    this.articulo.paginated.pageNumber=0;
                    this.articulo.data=response.data;
                }).catch((errors)=>{
                console.log(errors);
            });
        },
        selectArticuloForStock(articulo){
            this.articulo.one= articulo;
            this.getStockBySucursal(articulo.id_articulo);
        },
        getStockBySucursal(id_articulo){
            axios.get(urlGlobal.getStock+id_articulo)
                .then((response)=>{
                    this.articulo.stock.data=response.data;
                }).catch((errors)=>{
                console.log(errors);
            });
        },
        submitFormPrecios(){
            let inputs = this.articulosSucursales.attributes;
            axios.post(urlGlobal.postArticuPrecios, inputs
            ).then(response => {
                let id_articulo=this.articulosSucursales.attributes.id_articulo;
                this.articulosSucursales.attributes = Object.assign({}, this.articulosSucursales.model);
                this.articulosSucursales.attributes.id_articulo = id_articulo;
                if(this.articulosSucursales.modeEdit) {
                    this.articulosSucursales.modeEdit=false;
                    this.articulosSucursales.modeCreate=false;
                }
                this.notificationSuccess();
                this.getPreciosArticulo(this.articulosSucursales.attributes.id_articulo)
            }).catch(errors => {
                console.log('errors');
                this.notificationErrors2(errors);
            });
        },
        changeEditModePrecios(precios){
            this.articulosSucursales.modeCreate = true;
            this.articulosSucursales.modeEdit = true;
            this.articulosSucursales.attributes = precios;
            this.articulosSucursales.tempAttributes = Object.assign({},precios);
        },
        selectArticulo(articulo){
            this.articulosSucursales.precios=[];
            this.articulosSucursales.attributes.id_articulo = articulo.id_articulo;
            this.articulosSucursales.articulo = articulo;
            this.articulosSucursales.modeCreate=false;
            this.articulosSucursales.modeEdit=false;
            this.getPreciosArticulo(articulo.id_articulo);
        },
        cancelModeEditPrecios(){
            this.articulosSucursales.modeCreate = false;
            this.articulosSucursales.modeEdit = false;
            this.articulosSucursales.attributes = Object.assign({},this.articulosSucursales.model);
            this.articulosSucursales.tempAttributes = Object.assign({},this.articulosSucursales.model);
        },


        cleanDivisible(){
            this.articulo.attributes.dimensiones=Object.assign({},this.articulo.tempAttributes.dimensiones);
        },

        //<editor-fold desc="Methods of Entradas y salidas">
        submitFormEntradaSalidaArticulo(actividad){
            let inputs = this.entradaSalidaArticulos.attributes;
            inputs.actividad = actividad;
            axios.post(urlGlobal.resourcesEntradaSalidaArticulo, inputs
            ).then(response => {
                this.entradaSalidaArticulos.attributes= Object.assign({},this.entradaSalidaArticulos.model);
                this.entradaSalidaArticulos.hideSuggestions=true;
                setTimeout(()=> this.entradaSalidaArticulos.hideSuggestions=false, 0);
                this.notificationSuccess();
            }).catch(errors => {
                console.log('errors');
                this.notificationErrors(errors);
            });
        },
        getEntradaSalidaArticuloByRageDate(event){
            axios.post(urlGlobal.getEntradaSalidaByRangeDate, event
            ).then(response => {
                this.entradaSalidaArticulos.data = response.data;
                this.entradaSalidaArticulos.data_with_filters = this.entradaSalidaArticulos.data;
                this.entradaSalidaArticulos.paginated.pageNumber = 0;
            }).catch(errors => {
                console.log(errors);
            });
        },
        //</editor-fold>

        //<editor-fold desc="Methods of Filters">
        filterByEmpleado(empleado){
            if(empleado && empleado.nombre) {
                this.entradaSalidaArticulos.filters.empleado = empleado.nombre;
                this.goThroughFilters();
            }
        },
        filterByAlmacen: function(almacen){
            if(almacen.target.options.selectedIndex > -1) {
                let index = almacen.target.options.selectedIndex;
                this.entradaSalidaArticulos.filters.almacen = almacen.target.options[index].text;
                this.goThroughFilters();
            }
        },
        filterByActividad: function(actividad){
            this.entradaSalidaArticulos.filters.actividad = actividad.target.value;
            this.goThroughFilters();
            //this.entradaSalidaArticulos.filters.actividad = actividad.target.options[index].text;
            /*if(actividad.target.options.selectedIndex > -1) {
                let index = actividad.target.options.selectedIndex;
                this.goThroughFilters();
            }*/
        },

        removeFilters(){
            this.entradaSalidaArticulos.filters.almacen='';
            this.entradaSalidaArticulos.filters.empleado='';
            this.entradaSalidaArticulos.filters.actividad='';
            this.entradaSalidaArticulos.hideFilters = true;
            this.entradaSalidaArticulos.paginated.pageNumber = 0;
            setTimeout(()=>this.entradaSalidaArticulos.hideFilters = false,1);
            this.goThroughFilters();
        },
        viewDetallesVenta(detalles){
            this.venta.detallesVenta = detalles.detalles_venta;
        },
        goThroughFilters(){
            let filtered_data = this.entradaSalidaArticulos.data;
            if(this.entradaSalidaArticulos.filters.empleado.length>0){
                filtered_data = filtered_data.filter( _empleado =>{
                    return _empleado.empleado === this.entradaSalidaArticulos.filters.empleado;
                });
            }
            if(this.entradaSalidaArticulos.filters.almacen.length>0){
                filtered_data = filtered_data.filter( _almacen =>{
                    return _almacen.almacen === this.entradaSalidaArticulos.filters.almacen;
                });
            }
            if(this.entradaSalidaArticulos.filters.actividad.length>0){
                filtered_data = filtered_data.filter( _actividad =>{
                    return _actividad.actividad === this.entradaSalidaArticulos.filters.actividad;
                });
            }
            this.entradaSalidaArticulos.paginated.pageNumber = 0;
            this.entradaSalidaArticulos.data_with_filters=filtered_data;
        },

        //</editor-fold>
        //<editor-fold desc="Methods of Categorias">
        submitFormCategoria(){

            if(this.categoria.attributes.id_categoria===null) {
                this.registerCategoria();
            } else {
                this.updateCategorias();
            }
        },
        registerCategoria: function() {
            let input = this.categoria.attributes;
            axios.post( urlGlobal.resourcesCategorias, input)
                .then( response =>{
                    this.categoria.attributes = {
                        id_categoria: null,
                        categoria: '',
                        descripcion: '',
                    };
                    this.getCategorias(1);
                    this.categoria.errors = [];
                    // $("#myModal").modal('hide');
                    // toastr.success(response.data, 'Alerta de Exito', {timeOut: 10000});
                }).catch(errors =>{
                    console.log(errors);
                    this.categoria.errors = this.formatErrors(errors);
                });
        },
        getCategorias: function(page) {
            axios.get(urlGlobal.resourcesCategorias+'?page='+page)
                .then( response =>{
                    this.categoria.data = response.data.data;
                    this.categoria.pagination = response.data.pagination;
                }).catch((errors)=>{
                    console.log(errors);
                    this.categoria.errors = this.formatErrors(errors);
                });
        },
        deleteCategorias: function(id, index) {
            let r = confirm("Está seguro que desea eliminar");
            if (r === true) {
                axios.delete(urlGlobal.resourcesCategorias+'/'+id)
                    .then( response =>{
                        this.categoria.data.splice(index,1);
                        this.categoria.pagination.total -= 1;
                        this.categoria.pagination.last_page = Math.ceil(this.categoria.pagination.total/10);
                    }).catch((errors)=>{
                    console.log(errors);
                    this.categoria.errors = this.formatErrors(errors);
                });
            }
        },
        changeToEditModeCategoria(categoria){
            this.categoria.modeCreate = true;
            this.categoria.modeEdit = true;
            this.categoria.attributes = categoria;
            this.categoria.tempAttributes = Object.assign({},categoria);
        },
        cancelEditModeCategoria(){
            this.categoria.modeCreate = false;
            this.categoria.modeEdit = false;
            Object.assign(this.categoria.attributes, this.categoria.tempAttributes);
            this.categoria.attributes = new Object({
                id_categoria:null,
                categoria: '',
                descripcion: '',
            });
            this.categoria.tempAttributes = new Object({
                id_categoria:null,
                categoria: '',
                descripcion: '',
            });
        },
        updateCategorias: function() {
            let input = this.categoria.attributes;
            axios.put(urlGlobal.resourcesCategorias+'/'+input.id_categoria, input)
                .then( response =>{
                    this.categoria.modeCreate = false;
                    this.categoria.modeEdit = false;
                    this.categoria.attributes = new Object({
                        id_categoria:null,
                        categoria: '',
                        descripcion: '',
                    });
                    this.categoria.tempAttributes = new Object({
                        id_categoria:null,
                        categoria: '',
                        descripcion: '',
                    });
                }).catch((errors)=>{
                console.log(errors);
                this.categoria.errors = this.formatErrors(errors);
            });
        },
        //</editor-fold>

        //<editor-fold desc="Methods Fabricante">
        submitFormFabricante(){
            if(this.fabricante.attributes.id_fabricante===null) {
                this.registerFabricante();
            } else {
                this.updateFabricante();
            }
        },
        registerFabricante: function() {
            let input = this.fabricante.attributes;
            axios.post( urlGlobal.resourcesFabricante, input)
                .then( response =>{
                    this.fabricante.attributes = {
                        id_fabricante:null,
                        nombre: '',
                        contacto: '',
                        sitio_web: '',
                    };
                    this.getFabricantes(1);
                    this.fabricante.errors = [];
                    // $("#myModal").modal('hide');
                    // toastr.success(response.data, 'Alerta de Exito', {timeOut: 10000});
                }).catch(errors =>{
                console.dir(errors);
                this.fabricante.errors = this.formatErrors(errors);
            });
        },
        getFabricantes: function(page) {
            axios.get(urlGlobal.resourcesFabricante+'?page='+page)
                .then( response =>{
                    this.fabricante.data = response.data.data;
                    this.fabricante.pagination = response.data.pagination;
                }).catch((errors)=>{
                console.log(errors);
                this.fabricante.errors = this.formatErrors(errors);
            });
        },
        changeToEditModeFabricante(fabricante){
            this.fabricante.modeCreate = true;
            this.fabricante.modeEdit = true;
            this.fabricante.attributes = fabricante;
            this.fabricante.tempAttributes = Object.assign({},fabricante);
        },
        cancelEditModeFabricante(){
            this.fabricante.modeCreate = false;
            this.fabricante.modeEdit = false;
            Object.assign(this.fabricante.attributes, this.fabricante.tempAttributes);
            this.fabricante.attributes = new Object({
                id_fabricante:null,
                nombre: '',
                contacto: '',
                sitio_web: '',
            });
            this.fabricante.tempAttributes = new Object({
                id_fabricante:null,
                nombre: '',
                contacto: '',
                sitio_web: '',
            });
        },
        changeStatusOfArticulo(articulo){
            axios.put(urlGlobal.changeStatusOfArticulo+articulo.id_articulo,{status:articulo.estatus})
                .then( response =>{
                    articulo.estatus = articulo.estatus===0 ? 1:0;
                }).catch((errors)=>{
                console.log(errors);
                this.fabricante.errors = this.formatErrors(errors);
            });
        },
        deleteFabricante: function(id, index) {
            let r = confirm("ESTÁ SEGURO");
            if (r === true) {
                axios.delete(urlGlobal.resourcesFabricante+'/'+id)
                    .then( response =>{
                        this.fabricante.data.splice(index,1);
                        this.fabricante.pagination.total -= 1;
                        this.fabricante.pagination.last_page = Math.ceil(this.fabricante.pagination.total/10);
                    }).catch((errors)=>{
                    console.log(errors);
                    this.categoria.errors = this.formatErrors(errors);
                });
            }
        },
        updateFabricante: function() {
            let input = this.fabricante.attributes;
            axios.put(urlGlobal.resourcesFabricante+'/'+input.id_fabricante, input)
                .then( response =>{
                    this.fabricante.modeCreate = false;
                    this.fabricante.modeEdit = false;
                    this.fabricante.attributes = new Object({
                        id_fabricante:null,
                        nombre: '',
                        contacto: '',
                        sitio_web: '',
                    });
                    this.fabricante.tempAttributes = new Object({
                        id_fabricante:null,
                        nombre: '',
                        contacto: '',
                        sitio_web: '',
                    });
                }).catch((errors)=>{
                console.log(errors);
                this.fabricante.errors = this.formatErrors(errors);
            });
        },
        //</editor-fold>

        //<editor-fold desc="Methods of Articulos">

        submitArticulo(){
            if(this.articulo.attributes.id_articulo){
                this.updateArticulo();
            } else {
                this.registerArticulo();
            }
        },
        registerArticulo(){

            let inputs = Object.assign({}, this.articulo.attributes);
            let formData = new FormData();
            formData.append('imagen', inputs.imagen);
            delete inputs.imagen;
            formData.append('data', JSON.stringify(inputs) );

            axios.post( urlGlobal.resourcesArticulo, formData/*,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }*/
            ).then( response => {
                this.articulo.attributes = {
                    id_articulo:null,
                    nombre: '',
                    codigo: '',
                    codigo_barra:'',
                    caracteristicas:'',
                    precio_compra:null,
                    precio_produccion:null,
                    estatus:'',
                    imagen:'',
                    fecha_registro:'',
                    divisible:0,
                    dimensiones:{
                        largo:null,
                        ancho:null,
                        espesor:null,
                        volumen:null
                    },
                    id_fabricante:null,
                    id_categoria:null
                };
                this.articulo.errors = [];
                this.$refs.inputCategoria.value = '';
                this.$refs.inputFabricante.value = '';
                this.notificationSuccess();
            }).catch( errors => {
                console.log('FAILURE!!');
                this.notificationErrors2(errors);
            });
        },
        updateArticulo(){
            let inputs = Object.assign({}, this.articulo.attributes);
            let formData = new FormData();
            formData.append('imagen', inputs.imagen);
            delete inputs.imagen;
            formData.append('data', JSON.stringify(inputs) );
            formData.append('_method', 'PUT');
            axios.post( urlGlobal.resourcesArticulo+'/update/'+inputs.id_articulo, formData,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then( response => {
                this.articulo.modeCreate = false;
                this.articulo.modeEdit = false;
                this.articulo.tempAttributes = new Object({
                    id_articulo:null,
                    nombre: '',
                    codigo: '',
                    codigo_barra:'',
                    caracteristicas:'',
                    precio_compra:null,
                    precio_produccion:null,
                    estatus:'',
                    imagen:'',
                    fecha_registro:'',
                    divisible:0,
                    dimensiones:{
                        largo:null,
                        ancho:null,
                        espesor:null,
                        volumen:null
                    },
                    id_fabricante:null,
                    id_categoria:null
                });
                this.articulo.attributes =  new Object({
                    id_articulo:null,
                    nombre: '',
                    codigo: '',
                    codigo_barra:'',
                    caracteristicas:'',
                    precio_compra:null,
                    precio_produccion:null,
                    estatus:'',
                    imagen:'',
                    fecha_registro:'',
                    divisible:0,
                    dimensiones:{
                        largo:null,
                        ancho:null,
                        espesor:null,
                        volumen:null
                    },
                    id_fabricante:null,
                    id_categoria:null
                });
                this.articulo.errors = [];
                this.$refs.inputCategoria.value = '';
                this.$refs.inputFabricante.value = '';
                this.notificationSuccess();
            }).catch( errors => {
                console.log('FAILURE!!');
                this.notificationErrors2(errors);
            });
        },
        getArticuloByCodigoBarras: function(codigoBarras) {
            if (!codigoBarras.target.value.length <= 0) {
                axios.get(urlGlobal.getArticuloForCodigoBarras + codigoBarras.target.value
                ).then(response => {
                    this.articulo.paginated.pageNumber=0;
                    if( Object.keys(response.data).length === 0){
                        this.articulo.data = [];
                    } else {
                        this.articulo.data = response.data;
                    }
                }).catch(errors => {
                    console.log(errors);
                });
            }
        },
        getArticuloByCodigo: function(codigo) {
            if (!codigo.target.value.length <= 0) {
                axios.get(urlGlobal.getArticuloForCodigo + codigo.target.value
                ).then(response => {
                    this.articulo.paginated.pageNumber=0;
                    if( Object.keys(response.data).length === 0){
                        this.articulo.data
                    } else {
                        this.articulo.data = response.data;
                    }
                }).catch(errors => {
                    console.log(errors);
                });
            }
        },
        getArticuloByNombre(result){
            if (result && result.id) {
                axios.get(urlGlobal.getArticuloForId + result.id
                ).then(response => {
                    this.articulo.paginated.pageNumber=0;
                    this.articulo.data = response.data;
                }).catch(errors => {
                    console.log(errors);
                });
            }
        },
        selectArticuloForEntradaSalida(articulo){
            if (articulo && articulo.id_articulo){
                this.articulo.oneArticulo=articulo;
                this.entradaSalidaArticulos.attributes.id_articulo=articulo.id_articulo;
            } else {
                this.articulo.oneArticulo=null;
                this.entradaSalidaArticulos.attributes.id_articulo=null;
            }
        },
        changeToEditModeArticulo(articulo){
            this.articulo.modeCreate = true;
            this.articulo.modeEdit = true;
            this.articulo.attributes = articulo;
            if(articulo.categoria && articulo.categoria.id_categoria) {
                setTimeout(() => {
                    this.$refs.inputCategoria.value = articulo.categoria.categoria;
                }, 500);
                this.articulo.attributes.id_categoria = articulo.categoria.id_categoria;
            }
            if(articulo.fabricante && articulo.fabricante.id_fabricante){
                setTimeout(() => {
                    this.$refs.inputFabricante.value = articulo.fabricante.nombre;
                }, 500);
                this.articulo.attributes.id_fabricante = articulo.fabricante.id_fabricante;
            }
            this.articulo.tempAttributes = JSON.parse(JSON.stringify(articulo));
        },
        cancelEditModeAriculo(){
            this.articulo.modeCreate = false;
            this.articulo.modeEdit = false;
            Object.assign(this.articulo.attributes, this.articulo.tempAttributes);
            this.articulo.attributes = new Object({
                id_articulo:null,
                nombre: '',
                codigo: '',
                codigo_barra:'',
                caracteristicas:'',
                precio_compra:null,
                precio_produccion:null,
                estatus:'',
                imagen:'',
                fecha_registro:'',
                divisible:0,
                dimensiones:{
                    largo:null,
                    ancho:null,
                    espesor:null,
                    volumen:null
                },
                id_fabricante:null,
                id_categoria:null
            });
            this.articulo.tempAttributes = new Object({
                id_articulo:null,
                nombre: '',
                codigo: '',
                codigo_barra:'',
                caracteristicas:'',
                precio_compra:null,
                precio_produccion:null,
                estatus:'',
                imagen:'',
                fecha_registro:'',
                divisible:0,
                dimensiones:{
                    largo:null,
                    ancho:null,
                    espesor:null,
                    volumen:null
                },
                id_fabricante:null,
                id_categoria:null
            });
        },
        getArticuloByFilters(){
            let params = `?id_categoria=${this.filter.id_categoria}&id_fabricante=${this.filter.id_fabricante}`;
            axios.get(urlGlobal.getArticuloByFilters+params
            ).then(response => {
                this.articulo.paginated.pageNumber=0;
                this.articulo.data = response.data;
            }).catch(errors => {
                console.log(errors);
            });
        },
        //</editor-fold>

        //<editor-fold desc="Manejadores">
        handleFileUpload(event){
            this.articulo.attributes.imagen = event.target.files[0];
        },
        handleDatalistFabricante(event){
            for (let fabricante in this.fabricante.data ){
                if(this.fabricante.data[fabricante].nombre === event.target.value.toString()) {
                    this.articulo.attributes.id_fabricante = this.fabricante.data[fabricante].id_fabricante;
                    this.articulo.attributes.fabricante.nombre = this.fabricante.data[fabricante].nombre;
                    this.articulo.attributes.fabricante.id_fabricante = this.fabricante.data[fabricante].id_fabricante;
                    break;
                } else {
                    this.articulo.attributes.id_fabricante = null;
                    this.articulo.attributes.fabricante = Object.assign({}, this.fabricantes.tempAttributes);
                }
            }
        },
        handleDatalistCategoria(event){
            for (let _categoria in this.categoria.data ){
                if(this.categoria.data[_categoria].categoria === event.target.value.toString()) {
                    this.articulo.attributes.id_categoria = this.categoria.data[_categoria].id_categoria;
                    this.articulo.attributes.categoria.categoria = this.categoria.data[_categoria].categoria;
                    this.articulo.attributes.categoria.id_categoria = this.categoria.data[_categoria].id_categoria;
                    break;
                } else {
                    this.articulo.attributes.id_categoria = null;
                    this.articulo.attributes.categoria = Object.assign({}, this.categoria.tempAttributes);
                }
            }

        },
        //</editor-fold>
        //<editor-fold desc="Methods paginated">
        nextPage(){
            this.articulo.paginated.pageNumber++;
        },
        prevPage(){
            this.articulo.paginated.pageNumber--;
        },
        nextPageEntradasSalidas(){
            this.entradaSalidaArticulos.paginated.pageNumber++;
        },
        prevPageEntradasSalidas(){
            this.entradaSalidaArticulos.paginated.pageNumber--;
        },
        //</editor-fold>

        numberFloatDirective(event){
            let regex = new RegExp(/^[+]?([0-9]{0,})*[.]?([0-9]{1,2})?$/g);
            let specialKeys = [ 'Enter', 'Backspace', 'Tab', 'End', 'Home', 'Delete', 'ArrowLeft', 'ArrowUp', 'ArrowRight', 'ArrowDown'];

            if (specialKeys.indexOf(event.key) !== -1) {
                return true;
            }
            let current = event.target.value;
            let next = current.concat(event.key);
            if (next && !String(next).match(regex)) {
                event.preventDefault();
                return false;
            }
            return true;
        },
        numberPositiveDirective(event) {
            // Allow decimal numbers and negative values
            let regex = new RegExp(/^([0-9]*)$/gm);
            // Allow key codes for special events. Reflect :
            // Backspace, tab, end, home
            specialKeys = [ 'Enter', 'Backspace', 'Tab', 'End', 'Home', 'Delete',
                'ArrowLeft', 'ArrowUp', 'ArrowRight', 'ArrowDown'];
            // Allow Backspace, tab, end, and home keys}
            if (specialKeys.indexOf(event.key) !== -1) {
                return true;
            }
            let current = event.target.value;
            let next = current.concat(event.key);
            if (next && !String(next).match(regex)) {
                event.preventDefault();
                return false;
            }
            return true;
        },

        //<editor-fold desc="Methods of Notifications">
        formatErrors: function (errors) {
            let _errors = errors.response.data.errors;
            let response = [];
            Object.keys(errors.response.data.errors).forEach(value => {
                response.push('<li>'+_errors[value][0]+'</li>');
            });
            return response
        },
        formatErrors2: function (errors) {
            let _errors = errors.response.data;
            let response = [];
            Object.keys(errors.response.data).forEach(value => {
                response.push('<li>'+_errors[value][0]+'</li>');
            });
            return response
        },
        notificationSuccess(){
            toastr.success('Tarea realizada con Exito', {timeOut: 10000});
        },
        notificationErrors(errors){
            let _errors;
            _errors = this.formatErrors(errors);
            toastr.error(_errors, 'Corrija los Siguientes Errores', {timeOut: 10000});
        },
        notificationErrors2(errors){
            let _errors;
            _errors = this.formatErrors2(errors);
            toastr.error(_errors, 'Corrija los Siguientes Errores', {timeOut: 10000});
        },
        //</editor-fold
    }
});