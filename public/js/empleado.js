var appEmpleado = new Vue({
    el: '#app-empleado',
    data: {
        empleado: {
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
                id_empleado:null,
                nombre:'',
                ci:'',
                sexo:'',
                fecha_nacimiento:null,
                telefono:null,
                celular:null,
                correo:'',
                direccion:'',
                foto:null,
                persona_referencia:'',
                telefono_referencia:'',
                fecha_registro:null,
                status:'',
                id_sucursal:null,
            },
            tempAttributes: {
                id_empleado:null,
                nombre:'',
                ci:'',
                sexo:'',
                fecha_nacimiento:null,
                telefono:null,
                celular:null,
                correo:'',
                direccion:'',
                foto:null,
                persona_referencia:'',
                telefono_referencia:'',
                fecha_registro:null,
                status:'',
                id_sucursal:null,
            }
        },
        toggleEmpleadoKardex: true,
        toggleEmpleadoCreate: true,
        errorsKardex: [],
    },
     mounted(){
        this.getEmpleados(1);
    },
     computed: {
        pagesNumberEmpleado: function () {
            let pagesArray = [];
            let from = 1;
            while (from <= this.empleado.pagination.last_page) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;
        },

    },

    methods: {
    //<editor-fold desc="Methods of Categorias">
    submitFormEmpelado(){

        if(this.empleado.attributes.id_empleado===null) {
            this.registerEmpleado();
        } else {
            this.updateEmpleados();
        }
    },
    registerEmpleado: function() {
        let input = this.empleado.attributes;
        axios.post( urlGlobal.resourcesEmpleados, input)
            .then((response)=>{
                this.empleado.attributes = {
                    id_empleado: null,
                    nombre:'',
                    ci:'',
                    sexo:'',
                    fecha_nacimiento:null,
                    telefono:null,
                    celular:null,
                    correo:'',
                    direccion:'',
                    foto:null,
                    persona_referencia:'',
                    telefono_referencia:'',
                    fecha_registro:null,
                    status:'',
                    id_sucursal:null,
                };
                this.getEmpleados(1);
                this.empleado.errors = [];
                // $("#myModal").modal('hide');
                // toastr.success(response.data, 'Alerta de Exito', {timeOut: 10000});
            }).catch(errors =>{
                console.log(errors);
                this.empleado.errors = this.formatErrors(errors);
            });
    },
    getEmpleados: function(page) {
        axios.get(urlGlobal.resourcesEmpleados+'?page='+page)
            .then((response)=>{
                this.empleado.data = response.data.data;
                this.empleado.pagination = response.data.pagination;
            }).catch((errors)=>{
                console.log(errors);
                this.empleado.errors = this.formatErrors(errors);
            });
    },
/*    deleteEmpleados: function(id, index) {
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
    changeToEditModeEmpleado(categoria){
        this.categoria.modeCreate = true;
        this.categoria.modeEdit = true;
        this.categoria.attributes = categoria;
        this.categoria.tempAttributes = Object.assign({},categoria);
    },
    cancelEditModeEmpleado(){
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
    updateEmpleados: function() {
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
    },*/
    //</editor-fold>

    }
});