var appArticulo = new Vue({
    el: '#app-articulo',
    data: {
        //========= categorias =========

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
            allData: [],
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
            allData: [],
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
            data: null,
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
            }
        }
        // ============================

    },
    mounted(){
        this.getCategorias(1);
        this.getFabricantes(1);
    },
    computed: {
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
                this.notificationErrors(errors);
            });
        },
        getArticuloByCodigoBarras: function(codigoBarras) {
            if (!codigoBarras.target.value.length <= 0) {
                axios.get(urlGlobal.getArticuloForCodigoBarras + codigoBarras.target.value
                ).then(response => {
                    if( Object.keys(response.data).length === 0){
                        this.articulo.data = null;
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
                    if( Object.keys(response.data).length === 0){
                        this.articulo.data = null;
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
                    this.articulo.data = response.data;
                }).catch(errors => {
                    console.log(errors);
                });
            }
        },
        changeToEditModeArticulo(articulo){
            this.articulo.modeCreate = true;
            this.articulo.modeEdit = true;
            this.articulo.attributes = articulo;
            if(articulo.categoria) {
                setTimeout(() => {
                    this.$refs.inputCategoria.value = articulo.categoria.categoria;
                }, 500);
                this.articulo.attributes.id_categoria = articulo.categoria.id_categoria;
            }
            if(articulo.fabricante){
                setTimeout(() => {
                    this.$refs.inputFabricante.value = articulo.fabricante.nombre;;
                }, 500);
                this.articulo.attributes.id_fabricante = articulo.fabricante.id_fabricante;
            }
            this.articulo.tempAttributes = JSON.parse(JSON.stringify(articulo));
        },
        cancelEditModeAriculo(){
            this.articulo.modeCreate = false;
            this.articulo.modeEdit = false;
            Object.assign(this.fabricante.attributes, this.articulo.tempAttributes);
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
        //</editor-fold>

        //<editor-fold desc="Manejadores">
        handleFileUpload(event){
            this.articulo.attributes.imagen = event.target.files[0];
        },
        handleDatalistFabricante(event){
            for (let fabricante in this.fabricante.allData ){
                if(this.fabricante.allData[fabricante].nombre === event.target.value.toString()) {
                    this.articulo.attributes.id_fabricante = this.fabricante.allData[fabricante].id_fabricante;
                    break;
                } else {
                    this.articulo.attributes.id_fabricante = null;
                }
            }
        },
        handleDatalistCategoria(event){
            for (let categoria in this.categoria.allData ){
                if(this.categoria.allData[categoria].categoria === event.target.value.toString()) {
                    this.articulo.attributes.id_categoria = this.categoria.allData[categoria].id_categoria;
                    break;
                } else {
                    this.articulo.attributes.id_categoria = null;
                }
            }

        },
        //</editor-fold>
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