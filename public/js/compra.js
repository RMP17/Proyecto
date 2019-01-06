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
        }
    },
    mounted() {
        this.getProveedores();
        this.getMonedas();
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

        submitFormCuentaProveedor: function(){
            if(!this.cuenta_proveedor.attributes.id_cuenta){
                this.registerCuentaBanco();
            }
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







        getMonedas: function() {
            axios.get(urlGlobal.resourcesMoneda)
                .then(response => {
                    this.cuenta_proveedor.monedas = response.data;
                }).catch(errors => {
                console.log('errors');
            });
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