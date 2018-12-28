 // urlGlobal esta en desplegable_pais_ciudad.js
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
            modeCreate:false,
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
                dimensiones:[],
                id_fabricante:null
            },
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
                .then((response)=>{
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
                .then((response)=>{
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
                    .then((response)=>{
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
                .then((response)=>{
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
                .then((response)=>{
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
                .then((response)=>{
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
        deleteFabricante: function(id, index) {
            let r = confirm("Está seguro que desea eliminar");
            if (r === true) {
                axios.delete(urlGlobal.resourcesFabricante+'/'+id)
                    .then((response)=>{
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
                .then((response)=>{
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

        // test
        filter(event){
            console.dir(event);
        },
        formatErrors: function (errors) {
            let _errors = errors.response.data.errors;
            let response = [];
            Object.keys(errors.response.data.errors).forEach(value => {
                response.push(_errors[value][0]);
            });
            return response
        },
    }
});