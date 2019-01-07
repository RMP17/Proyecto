var appCompra = new Vue({
    el: '#app-compra',
    data: {
        proveedor: {
            config:{
                url:urlGlobal.suggestionsOfCiudades,
                placeholder:'Buscar por nombre de Ciudad',
                variableForSuggestions:'pais_ciudad',
                variableForSuggestionsId:'id_ciudad'
            },
            hideSuggestions:false,
            data: [],
            attributes: {
                id_proveedor:null,
                razon_social:'',
                nit:'',
                telefono:'',
                fax:'',
                celular:'',
                correo:'',
                sitio_web:'',
                direccion: '',
                fecha_registro: '',
                rubro: '',
                ciudad: {
                    id_ciudad:null,
                    nombre:'',
                    pais_ciudad:''
                },
                id_ciudad: ''
            },
            tempAttributes: {
                id_proveedor:null,
                razon_social:'',
                nit:'',
                telefono:'',
                fax:'',
                celular:'',
                correo:'',
                sitio_web:'',
                direccion: '',
                fecha_registro: '',
                rubro: '',
                ciudad: {
                    id_ciudad:null,
                    nombre:'',
                    pais_ciudad:''
                }
                ,
                id_ciudad: ''
            }
        },
        cuenta_proveedor:{
            modeEdit:false,
            modeCreate:false,
            monedas:[],
            cuentas:[],
            attributes: {
                id_cuenta: null,
                entidad: '',
                nro_cuenta: null,
                id_moneda: null,
                id_proveedor: null,
            }
        },
        contacto: {
            configProveedor:{
                url:urlGlobal.suggestionsOfProveedores,
                placeholder:'Buscar por nombre de proveedor',
                variableForSuggestions:'razon_social',
                variableForSuggestionsId:'id_proveedor'
            },
            hideSuggestions:false,
            data: [],
            cargos:[],
            attributes: {
                id_contacto: null,
                nombre: '',
                telefono: '',
                interno: '',
                celular: '',
                correo: '',
                fecha_registro: '',
                estatus: '',
                id_proveedor: null,
                id_cargo: null,
                proveedor:{
                    id_proveedor: null,
                    razon_social: '',
                    nit: ''
                },
            },
            tempAttributes: {
                id_contacto: null,
                nombre: '',
                telefono: '',
                interno: '',
                celular: '',
                correo: '',
                fecha_registro: '',
                estatus: '',
                id_proveedor: null,
                id_cargo: null,
                proveedor:{
                    id_proveedor: null,
                    razon_social: '',
                    nit: ''
                },
            }
        }
    },
    mounted() {
        this.getProveedores();
        this.getMonedas();
        this.getCargos();
    },
    methods: {
        //<editor-fold desc="Methods Proveedor">
        submitFormProveedor() {
            if (!this.proveedor.attributes.id_proveedor) {
                this.registerProveedor();
            } else {
                this.updateProveedor();
            }
        },
        registerProveedor: function() {
            let input = this.proveedor.attributes;
            axios.post(urlGlobal.resourcesProveedor, input)
                .then(response => {
                    this.proveedor.attributes = {
                        id_proveedor:null,
                        razon_social:'',
                        nit:'',
                        telefono:'',
                        fax:'',
                        celular:'',
                        correo:'',
                        sitio_web:'',
                        direccion: '',
                        fecha_registro: '',
                        rubro: '',
                        ciudad: {
                            id_ciudad:null,
                            nombre:'',
                            pais_ciudad:''
                        }
                        ,
                        id_ciudad: ''
                    };
                    this.getProveedores();
                    this.notificationSuccess();
                }).catch(errors => {
                console.log('errors');
                this.notificationErrors(errors);
            });

        },
        updateProveedor:function () {
            let inputs = Object.assign({},this.proveedor.attributes);
            axios.put(urlGlobal.resourcesProveedor + '/' + inputs.id_proveedor, inputs)
                .then(response => {
                    $('#modal-edit-proveedor').modal('hide');
                    Object.assign(this.proveedor.tempAttributes ,this.proveedor.attributes);
                    this.proveedor.attributes = new Object({
                        id_proveedor:null,
                        razon_social:'',
                        nit:'',
                        telefono:'',
                        fax:'',
                        celular:'',
                        correo:'',
                        sitio_web:'',
                        direccion: '',
                        fecha_registro: '',
                        rubro: '',
                        ciudad: {
                            id_ciudad:null,
                            nombre:'',
                            pais_ciudad:''
                        },
                        id_ciudad: ''
                    });
                    this.proveedor.tempAttributes = new Object({
                        id_proveedor:null,
                        razon_social:'',
                        nit:'',
                        telefono:'',
                        fax:'',
                        celular:'',
                        correo:'',
                        sitio_web:'',
                        direccion: '',
                        fecha_registro: '',
                        rubro: '',
                        ciudad: {
                            id_ciudad:null,
                            nombre:'',
                            pais_ciudad:''
                        },
                        id_ciudad: ''
                    });
                    this.notificationSuccess();
                }).catch(errors => {
                this.notificationErrors(errors);
            });
        },
        getProveedor(proveedor){
            if (proveedor && proveedor.id_ciudad) {
                this.proveedor.attributes.id_ciudad=proveedor.id_ciudad;
                this.proveedor.attributes.proveedor=proveedor.detalle;
            } else {
                this.proveedor.attributes.id_ciudad=null;
                this.proveedor.attributes.ciudad=null;
            }
        },
        getProveedores(){
            axios.get(urlGlobal.resourcesProveedor)
                .then(response => {
                    this.proveedor.data = response.data;
                }).catch(errors => {
                console.log('errors');
            })
        },
        modeEditProveedor(proveedor) {
            if(!proveedor.ciudad){
                proveedor.ciudad = {
                    id_ciudad:null,
                    nombre:'',
                    pais_ciudad:''
                }
            }
            proveedor.id_ciudad = proveedor.ciudad.id_ciudad;
            this.proveedor.tempAttributes = proveedor;
            this.proveedor.attributes = Object.assign({}, proveedor);
        },
        assignAnIdentificationToTheProvider(response) {
            if (response && response.id_ciudad) {
                this.proveedor.attributes.id_ciudad = response.id_ciudad;
                this.proveedor.attributes.ciudad = response;
            } else {
                this.proveedor.attributes.id_ciudad = null;
                this.proveedor.attributes.ciudad = {
                    id_ciudad:null,
                    nombre:'',
                    pais_ciudad:''
                };
            }
        },
        cancelModeEditProveedor() {
            this.proveedor.attributes = new Object({
                id_proveedor:null,
                razon_social:'',
                nit:'',
                telefono:'',
                fax:'',
                celular:'',
                correo:'',
                sitio_web:'',
                direccion: '',
                fecha_registro: '',
                rubro: '',
                ciudad: {
                    id_ciudad:null,
                    nombre:'',
                    pais_ciudad:''
                },
                id_ciudad: ''
            });
            this.proveedor.tempAttributes = new Object({
                id_proveedor:null,
                razon_social:'',
                nit:'',
                telefono:'',
                fax:'',
                celular:'',
                correo:'',
                sitio_web:'',
                direccion: '',
                fecha_registro: '',
                rubro: '',
                ciudad: {
                    id_ciudad:null,
                    nombre:'',
                    pais_ciudad:''
                },
                id_ciudad: ''
            });
        },
        //</editor-fold>

        //<editor-fold desc="Methods CuentaProveedor">
        submitmormCuentaProveedor: function(){
            if(!this.cuenta_proveedor.attributes.id_cuenta){
                this.registerCuentaBanco();
            } else {
                this.updateCuentaBanco();
            }
        },
        updateCuentaBanco:function () {
            let inputs = Object.assign({},this.cuenta_proveedor.attributes);
            axios.put(urlGlobal.resourcesCuentaProveedor + '/' + inputs.id_cuenta, inputs)
                .then(response => {
                    Object.assign(this.cuenta_proveedor.tempAttributes ,this.cuenta_proveedor.attributes);
                    this.cancelModeEditProveedor();
                    this.notificationSuccess();
                }).catch(errors => {
                this.notificationErrors(errors);
            });
        },
        registerCuentaBanco: function() {
            let input = this.cuenta_proveedor.attributes;
            axios.post(urlGlobal.resourcesCuentaProveedor, input)
                .then(response => {
                    this.cuenta_proveedor.attributes = {
                        id_cuenta: null,
                        entidad: '',
                        nro_cuenta: null,
                        moneda: null,
                        id_moneda: null,
                        proveedor: null,
                        id_proveedor: null,
                    };
                    this.getProveedores();
                    this.notificationSuccess();
                }).catch(errors => {
                console.log('errors');
                this.notificationErrors(errors);
            });

        },
        assignProveedor: function(proveedor){
            this.cuenta_proveedor.attributes.id_proveedor = proveedor.id_proveedor;
            this.cuenta_proveedor.cuentas = proveedor.cuentasProveedor;
        },
        assignMonedaCuenta: function(moneda){
            if(moneda.target.options.selectedIndex > -1) {
                let index = moneda.target.options.selectedIndex;
                console.dir(moneda.target.options[index]);
                this.cuenta_proveedor.attributes.moneda = moneda.target.options[index].text;
            }

        },
        changeModeEditCuentaProveedor: function(cuenta_proveedor){
            this.cuenta_proveedor.tempAttributes = cuenta_proveedor;
            this.cuenta_proveedor.attributes = Object.assign({}, cuenta_proveedor);
            this.cuenta_proveedor.modeEdit = true;
            this.cuenta_proveedor.modeCreate = true;
        },
        getMonedas: function() {
            axios.get(urlGlobal.resourcesMoneda)
                .then(response => {
                    this.cuenta_proveedor.monedas = response.data;
                }).catch(errors => {
                console.log('errors');
            });
        },
        // Todo: aqui te quedaste
        cancelModeEditProveedor: function() {
            this.cuenta_proveedor.attributes = new Object({
                id_cuenta: null,
                entidad: '',
                nro_cuenta: null,
                id_moneda: null,
                id_proveedor: null,
            });
            this.cuenta_proveedor.tempAttributes = new Object({
                id_cuenta: null,
                entidad: '',
                nro_cuenta: null,
                id_moneda: null,
                id_proveedor: null,
            });
            this.cuenta_proveedor.modeEdit = false;
            this.cuenta_proveedor.modeCreate = false;
        },
        deleteCuentaProveedor: function(id, index) {
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
        //</editor-fold>

        getCargos: function(){
            axios.get(urlGlobal.resourcesCargo)
                .then(response => {
                    this.contacto.cargos = response.data;
                }).catch(errors => {
                console.log('errors');
            });
        },
        assignAnIdentificationToContactOfProveedor(response) {
            if (response && response.id_proveedor) {
                this.contacto.attributes.id_proveedor = response.id_proveedor;
                this.contacto.attributes.proveedor = response;
            } else {
                this.contacto.attributes.id_proveedor = null;
                this.contacto.attributes.proveedor = {
                    id_proveedor: null,
                    razon_social: '',
                    nit: ''
                };
            }
        },

        submitFormContacto() {
            if (!this.proveedor.attributes.id_proveedor) {
                this.registerContacto();
            } else {
                this.updateProveedor();
            }
        },

        registerContacto: function() {
            let input = this.contacto.attributes;
            axios.post(urlGlobal.resourcesContacto, input)
                .then(response => {
                    this.contacto.attributes = {
                        id_contacto: null,
                        nombre: '',
                        telefono: '',
                        interno: '',
                        celular: '',
                        correo: '',
                        fecha_registro: '',
                        estatus: '',
                        id_proveedor: null,
                        id_cargo: null,
                        proveedor:{
                            id_proveedor: null,
                            razon_social: '',
                            nit: ''
                        },
                    };
                    //this.getProveedores();
                    this.contacto.hideSuggestions= true;
                    // $("#myModal").modal('hide');
                    setTimeout(()=>{
                        this.contacto.hideSuggestions = false;
                    },1);
                    this.notificationSuccess();
                }).catch(errors => {
                console.log('errors');
                this.notificationErrors(errors);
            });

        },
        getContactosDeProveedor(response){
            if (response && response.id_proveedor) {
                axios.get(urlGlobal.getContactoOfProveedor+response.id_proveedor
                ).then(response => {
                    this.contacto.data = response.data;
                }).catch(errors => {
                    console.log('errors');
                });
            } else {
                this.contacto.data = [];
            }
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
        }
        //</editor-fold>
    }

});