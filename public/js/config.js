var appConfig = new Vue({
    el: '#app-config',
    data: {
        pais: {
            config:{
                url:urlGlobal.getPaisesByName,
                placeholder:'Buscar por nombre de Pais',
                variableForSuggestions:'nombre',
                variableForSuggestionsId:'id_pais'
            },
            modeCreate: false,
            modeEdit: false,
            errors: [],
            onePais:null,
            data: [],
            suggestionData: [],     //Estos datos se cargar desde variables-globales-vue.js
            attributes: {
                id_pais:null,
                nombre: '',
            },
            tempAttributes: {
                id_pais:null,
                nombre: '',
            },
            ciudad:{
                modeCreate:false,
                modeEdit:false,
                data:[],
                attributes:{
                    id_ciudad:null,
                    nombre:'',
                    id_pais:null
                },
                tempAttributes:{
                    id_ciudad:null,
                    nombre:'',
                    id_pais:null
                },
                model:{
                    id_ciudad:null,
                    nombre:'',
                    id_pais:null
                }
            }
        },
        moneda:{
            hideSuggestions:false,
            data: [],
            attributes: {
                id_moneda:null,
                nombre: '',
                codigo: '',
                pais: {
                    id_pais:null,
                    nombre:''
                },
                id_pais:null,
            },
            tempAttributes: {
                id_moneda:null,
                nombre: '',
                codigo: '',
                pais: {
                    id_pais:null,
                    nombre:''
                },
                id_pais:null,
            }
        },
        cargo:{
            data: [],
            attributes: {
                id_cargo:null,
                nombre: '',
            },
            tempAttributes: {
                id_cargo:null,
                nombre: '',
            }
        },
        empleado: {
            /*config:{
                url:urlGlobal.suggestionsOfCiudades,
                placeholder:'Buscar por nombre de Ciudad',
                variableForSuggestions:'pais_ciudad',
                variableForSuggestionsId:'id_ciudad'
            },*/
            hideSuggestions:false,
            data: [],
            attributes: {
                id_empleado:null,
                nombre:'',
                ci:'',
                sexo:'',
                fecha_nacimiento:null,
                telefono:null,
                celular:null,
                correo:null,
                direccion:'',
                foto:null,
                persona_referencia:'',
                telefono_referencia:'',
                fecha_registro:null,
                estatus:'',
                id_almacen:null,
                kardex:{
                    id_kardex:null,
                    id_cargo:null,
                    fecha_inicio:null,
                    salario:{
                        monto:null,
                        id_moneda:null
                    }
                }
            },
            tempAttributes: {
                id_empleado:null,
                nombre:'',
                ci:'',
                sexo:'',
                fecha_nacimiento:null,
                telefono:null,
                celular:null,
                correo:null,
                direccion:'',
                foto:null,
                persona_referencia:'',
                telefono_referencia:'',
                fecha_registro:null,
                estatus:'',
                id_almacen:null,
                kardex:{
                    id_kardex:null,
                    id_cargo:null,
                    fecha_inicio:null,
                    salario:{
                        monto:null,
                        id_moneda:null
                    }
                }
            }
        },
        empresa: {
            data: [],
            oneEmpresa:null,
            attributes: {
                id_empresa:null,
                razon_social:'',
                nit:'',
                propietario:'',
                actividad:'',
            },
            tempAttributes: {
                id_empresa:null,
                razon_social:'',
                nit:'',
                propietario:'',
                actividad:'',
            }
        },
        empresa_sucursal: {
            config:{
                url:urlGlobal.suggestionsOfCiudades,
                placeholder:'Buscar por nombre de Ciudad',
                variableForSuggestions:'pais_ciudad',
                variableForSuggestionsId:'id_ciudad'
            },
            hideSuggestions:false,
            modeEdit:false,
            modeCreate:false,
            sucursales:[],
            attributes: {
                id_sucursal:null,
                nombre:'',
                casa_matriz:0,
                direccion:'',
                telefono:'',
                fecha_apertura:'',
                estatus:'',
                id_ciudad:'',
                ciudad: {
                    id_ciudad:null,
                    nombre:'',
                    pais_ciudad:''
                },
                id_empresa:'',
            },
            tempAttributes: {
                id_sucursal:null,
                nombre:'',
                casa_matriz:0,
                direccion:'',
                telefono:'',
                fecha_apertura:'',
                estatus:'',
                id_ciudad:'',
                ciudad: {
                    id_ciudad:null,
                    nombre:'',
                    pais_ciudad:''
                },
                id_empresa:'',
            }
        },
        almacen: {
            data: [],
            attributes: {
                id_almacen:null,
                codigo: '',
                direccion: '',
                id_sucursal: null,
            },
            tempAttributes: {
                id_almacen:null,
                codigo: null,
                direccion: '',
                id_sucursal: null,
            }
        },
        kardex: {
            currentTab:10,
            data: [],
            one:null,
            empleado:null,
            attributes:{
                fecha_inicio:null,
                id_moneda:null,
                id_cargo:null,
                id_empleado:null,
                salario:null,
            },
            model:{
                fecha_inicio:null,
                id_moneda:null,
                id_cargo:null,
                id_empleado:null,
                salario:null,
            },
            kardex_observaciones:{
                data:[],
                attributes:{
                    id_kardex_observacion:null,
                    id_kardex:null,
                    observacion:''
                },
                tempAttributes:{
                    id_kardex_observacion:null,
                    id_kardex:null,
                    observacion:''
                }
            },
        },
        acceso: {
            currentTab:10,
            permisos:[],
            data: [],
            empleado:{
                id_empleado:null,
                nombre:''
            },
            attributes: {
                id_empleado:null,
                usuario:'',
                pass:'',
                permisos_permitidos:[]
            },
            kardex_observaciones:{
                data:[],
                attributes:{
                    id_kardex_observacion:null,
                    id_kardex:null,
                    observacion:''
                },
                tempAttributes:{
                    id_kardex_observacion:null,
                    id_kardex:null,
                    observacion:''
                }
            },
            /*tempAttributes: {
                id_almacen:null,
                codigo: null,
                direccion: '',
                id_sucursal: null,
            }*/
        },
    },
    created:function(){
        this.$nextTick(function () {
            this.getMonedas();
            this.getCargo();
            this.getEmpresas();
            this.getSucursalesAlmacen();
            this.getAlmacen();
            this.getEmpleados();
            this.getPermisos();
            this.getPaises();
        })
    },
    methods: {
        //<editor-fold desc="Methods of Pais">
        submitFormPais() {
            if (!this.pais.attributes.id_pais) {
                this.registerPais();
            } else {
                this.updatePais();
            }
        },
        registerPais() {
            let input = this.pais.attributes;
            axios.post(urlGlobal.resourcesPais, input)
                .then(response => {
                    this.pais.attributes = {
                        id_pais: null,
                        nombre: ''
                    };
                    this.pais.errors = [];
                    // $("#myModal").modal('hide');
                    this.notificationSuccess();
                }).catch(errors => {
                console.log('errors');
                this.notificationErrors2(errors);
            });

        },
        updatePais() {
            let input = this.pais.attributes;
            axios.put(urlGlobal.resourcesPais + '/' + this.pais.attributes.id_pais, input)
                .then(response => {
                    $('#modal-pais').modal('hide');
                    Object.assign(this.pais.tempAttributes, this.pais.attributes);
                    this.pais.attributes = new Object({
                        id_pais: null,
                        nombre: '',
                    });
                    this.pais.tempAttributes = new Object({
                        id_pais: null,
                        nombre: '',
                    });
                    this.pais.errors = [];
                    // $("#myModal").modal('hide');
                    // toastr.success(response.data, 'Alerta de Exito', {timeOut: 10000});
                }).catch(errors => {
                console.log('errors');
                this.formatErrors(errors);
            });

        },
        getPaisById(response) {
            if (response && response.id) {
                axios.get(urlGlobal.getPaisesById + response.id
                ).then(response => {
                    this.pais.data = response.data;
                }).catch(errors => {
                    console.log(errors);
                });
            }
        },
        getPaises() {
            axios.get(urlGlobal.resourcesPais
            ).then(response => {
                this.pais.data = response.data;
            }).catch(errors => {
                console.log(errors);
            });
        },
        submitFormCiudad(){
            if (!this.pais.ciudad.attributes.id_ciudad) {
                this.addCiudadToPais();
            } else {
                this.updateCiudad();
            }
        },
        addCiudadToPais() {
            let inputs = Object.assign({},this.pais.ciudad.attributes);
            inputs.id_pais=this.pais.onePais.id_pais;
            axios.post(urlGlobal.addCiudadToPais, inputs
            ).then(response => {
                inputs.id_ciudad=response.data.id_ciudad;
                this.pais.onePais.ciudades.push(inputs);
                this.pais.ciudad.attributes = Object.assign({},this.pais.ciudad.model);
                this.notificationSuccess();
            }).catch(errors => {
                console.log('errors');
                this.notificationErrors2(errors);
            });

        },
        updateCiudad() {
            let inputs = Object.assign({},this.pais.ciudad.attributes);
            axios.put(urlGlobal.resourcesCiudad + '/'+ inputs.id_ciudad, inputs)
                .then(response => {
                    Object.assign(this.pais.ciudad.tempAttributes ,this.pais.ciudad.attributes);
                    this.pais.ciudad.attributes = Object.assign({},this.pais.ciudad.model);
                    this.pais.ciudad.tempAttributes = Object.assign({},this.pais.ciudad.model);
                    this.notificationSuccess();
                    this.cancelModeEditCiudad();
                }).catch(errors => {
                this.notificationErrors(errors);
            });
        },
        modeEditPais(pais) {
            this.pais.tempAttributes = pais;
            this.pais.attributes = Object.assign({}, pais);
        },
        modeEditCiudad(ciudad) {
            this.pais.ciudad.modeCreate=true;
            this.pais.ciudad.modeEdit=true;
            this.pais.ciudad.tempAttributes = ciudad;
            this.pais.ciudad.attributes = Object.assign({}, ciudad);
        },
        cancelModeEdit() {
            this.pais.attributes = new Object({
                id_pais: null,
                nombre: '',
            });
            this.pais.tempAttributes = new Object({
                id_pais: null,
                nombre: '',
            });
        },
        //</editor-fold>

        cancelModeEditCiudad(){
            this.pais.ciudad.attributes = Object.assign({},this.pais.ciudad.model);
            this.pais.ciudad.tempAttributes = Object.assign({},this.pais.ciudad.model);
            this.pais.ciudad.modeEdit = false;
            this.pais.ciudad.modeCreate = false;
        },

        showCities(pais) {
            this.pais.ciudad.data = pais.ciudades;
            this.pais.onePais = pais;
        },


        //<editor-fold desc="Methods Moneda">
        submitFormMoneda() {
            if (!this.moneda.attributes.id_moneda) {
                this.registerMoneda();
            } else {
                this.updateMoneda();
            }
        },
        getMonedas(){
            axios.get(urlGlobal.resourcesMoneda
            ).then(response => {
                this.moneda.data = response.data;
            }).catch(errors => {
                console.log('errors');
            });
        },
        assignAnIdentificationToTheCcurrency(response) {
            if (response && response.id_pais) {
               this.moneda.attributes.id_pais = response.id_pais;
               this.moneda.attributes.pais = response;
            } else {
                this.moneda.attributes.id_pais = null;
                this.moneda.attributes.pais = {
                    id_pais:null,
                    nombre:''
                };
            }

        },
        registerMoneda(){
            let input = Object.assign({},this.moneda.attributes);
            delete input.pais;
            axios.post(urlGlobal.resourcesMoneda, input)
                .then(response => {
                    this.getMonedas();
                    this.moneda.attributes = {
                        id_moneda:null,
                        nombre: '',
                        codigo: '',
                        pais: {
                            id_pais:null,
                            nombre:''
                        },
                        id_pais:null,
                    };
                    this.moneda.hideSuggestions= true;
                    // $("#myModal").modal('hide');
                    setTimeout(()=>{
                        this.moneda.hideSuggestions = false;
                    },1);
                    this.notificationSuccess();
                }).catch(errors => {
                this.notificationErrors(errors);
                //toastr.warning(_errors);
            });
        },
        updateMoneda(){
            let input = Object.assign({},this.moneda.attributes);
            delete input.pais;
            axios.put(urlGlobal.resourcesMoneda + '/'+ input.id_moneda, input)
                .then(response => {
                    $('#modal-edit-moneda').modal('hide');
                    Object.assign(this.moneda.tempAttributes ,this.moneda.attributes);
                    this.moneda.hideSuggestions= true;
                    // $("#myModal").modal('hide');
                    setTimeout(()=>{
                        this.moneda.hideSuggestions = false;
                    },1);
                    this.moneda.attributes = new Object({
                        id_moneda:null,
                        nombre: '',
                        codigo: '',
                        pais: {
                            id_pais:null,
                            nombre:''
                        },
                        id_pais:null,
                    });
                    this.moneda.tempAttributes = new Object({
                        id_moneda:null,
                        nombre: '',
                        codigo: '',
                        pais: {
                            id_pais:null,
                            nombre:''
                        },
                        id_pais:null,
                    });
                    this.notificationSuccess();
                }).catch(errors => {
                this.notificationErrors(errors);
            });
        },
        modeEditMoneda(moneda) {
            if(!moneda.pais){
                moneda.pais = {
                    id_pais:null,
                    nombre:''
                }
            }
            moneda.id_pais = moneda.pais.id_pais;
            this.moneda.tempAttributes = moneda;
            this.moneda.attributes = Object.assign({}, moneda);
        },
        cancelModeEditMoneda() {
            this.moneda.attributes = new Object({
                id_moneda:null,
                nombre: '',
                codigo: '',
                pais: {
                    id_pais:null,
                    nombre:''
                },
            });
            this.moneda.tempAttributes = new Object({
                id_moneda:null,
                nombre: '',
                codigo: '',
                pais: {
                    id_pais:null,
                    nombre:''
                },
            });
        },
        //</editor-fold>

        //<editor-fold desc="Methods Cargo">
        submitFormCargo() {
            if (!this.cargo.attributes.id_cargo) {
                this.registerCargo();
            } else {
                this.updateCargo();
            }
        },
        getCargo(){
            axios.get(urlGlobal.resourcesCargo
            ).then(response => {
                this.cargo.data = response.data;
            }).catch(errors => {
                console.log('errors');
            });
        },
        registerCargo(){
            let input = Object.assign({},this.cargo.attributes);
            axios.post(urlGlobal.resourcesCargo, input)
                .then(response => {
                    this.getCargo();
                    this.cargo.attributes = new Object({
                        id_cargo:null,
                        nombre: '',
                    });
                    this.moneda.tempAttributes = new Object({
                        id_cargo:null,
                        nombre: '',
                    });
                    this.notificationSuccess();
                }).catch(errors => {
                this.notificationErrors(errors);
                //toastr.warning(_errors);
            });
        },
        updateCargo(){
            let input = Object.assign({},this.cargo.attributes);
            axios.put(urlGlobal.resourcesCargo + '/'+ input.id_cargo, input)
                .then(response => {
                    $('#modal-edit-cargo').modal('hide');
                    Object.assign(this.cargo.tempAttributes ,this.cargo.attributes);
                    this.cargo.attributes = new Object({
                        id_cargo:null,
                        nombre: '',
                    });
                    this.cargo.tempAttributes = new Object({
                        id_cargo:null,
                        nombre: '',
                    });
                    this.notificationSuccess();
                }).catch(errors => {
                this.notificationErrors(errors);
            });
        },
        modeEditCargo(cargo) {
            this.cargo.tempAttributes = cargo;
            this.cargo.attributes = Object.assign({}, cargo);
        },
        cancelModeEditCargo() {
            this.cargo.attributes = new Object({
                id_cargo:null,
                nombre: '',
            });
            this.cargo.tempAttributes = new Object({
                id_cargo:null,
                nombre: '',
            });
        },
        //</editor-fold>

        //<editor-fold desc="Methods of Empresa">
        submitFormEmpresa() {
            if (!this.empresa.attributes.id_empresa) {
                this.registerEmpresa();
            } else {
                this.updateEmpresa();
            }
        },
        getEmpresas(){
            axios.get(urlGlobal.resourcesEmpresa
            ).then(response => {
                this.empresa.data = response.data;
                if(this.empresa_sucursal.attributes.id_empresa){
                    this.findSucursales(this.empresa_sucursal.attributes.id_empresa);
                }
            }).catch(errors => {
                console.log('errors');
            });
        },
        registerEmpresa(){
            let inputs = Object.assign({},this.empresa.attributes);
            axios.post(urlGlobal.resourcesEmpresa, inputs
            ).then(response => {
                this.getEmpresas();
                this.empresa.attributes = new Object({
                    id_empresa:null,
                    razon_social:'',
                    nit:'',
                    propietario:'',
                    actividad:'',
                });
                this.notificationSuccess();
            }).catch(errors => {
                this.notificationErrors(errors);
                //toastr.warning(_errors);
            });
        },
        updateEmpresa(){
            let inputs = Object.assign({},this.empresa.attributes);
            axios.put(urlGlobal.resourcesEmpresa + '/'+ inputs.id_empresa, inputs)
                .then(response => {
                    $('#modal-edit-empresa').modal('hide');
                    Object.assign(this.empresa.tempAttributes ,this.empresa.attributes);
                    this.empresa.attributes = new Object({
                        id_empresa:null,
                        razon_social:'',
                        nit:'',
                        propietario:'',
                        actividad:'',
                    });
                    this.empresa.tempAttributes = new Object({
                        id_empresa:null,
                        razon_social:'',
                        nit:'',
                        propietario:'',
                        actividad:'',
                    });
                    this.notificationSuccess();
                }).catch(errors => {
                this.notificationErrors(errors);
            });
        },
        modeEditEmpresa(empresa) {
            this.empresa.tempAttributes = empresa;
            this.empresa.attributes = Object.assign({}, empresa);
        },
        cancelModeEditEmpresa() {
            $('#modal-edit-empresa').modal('hide');
            this.empresa.attributes = new Object({
                id_empresa:null,
                razon_social:'',
                nit:'',
                propietario:'',
                actividad:'',
            });
            this.empresa.tempAttributes = new Object({
                id_empresa:null,
                razon_social:'',
                nit:'',
                propietario:'',
                actividad:'',
            });
        },
        //</editor-fold>


        //<editor-fold desc="Methods of Empresa Sucursal">
        submitFormEmpresaSucursal() {
            if (!this.empresa_sucursal.attributes.id_sucursal) {
                this.registerEmpresaSucursal();
            } else {
                this.updateEmpresaSucursal();
            }
        },

        registerEmpresaSucursal(){
            let inputs = Object.assign({},this.empresa_sucursal.attributes);
            axios.post(urlGlobal.addSucursalToEmpresa+inputs.id_empresa, inputs
            ).then(response => {
                let id_empresa = this.empresa_sucursal.attributes.id_empresa;
                this.empresa_sucursal.attributes = new Object({
                    id_sucursal:null,
                    nombre:'',
                    casa_matriz:0,
                    direccion:'',
                    telefono:'',
                    fecha_apertura:'',
                    estatus:'',
                    id_ciudad:'',
                    ciudad:'',
                    id_empresa:'',
                });
                this.empresa_sucursal.attributes.id_empresa= id_empresa;
                this.empresa_sucursal.hideSuggestions = true;
                setTimeout(()=>{
                    this.empresa_sucursal.hideSuggestions = false;
                },1);
                this.getEmpresas();
                this.notificationSuccess();
            }).catch(errors => {
                console.log('errors');
                this.notificationErrors(errors);
            });
        },
        updateEmpresaSucursal(){
            let inputs = Object.assign({},this.empresa_sucursal.attributes);
            axios.put(urlGlobal.resourcesSucursal + '/'+ inputs.id_sucursal, inputs)
                .then(response => {
                    Object.assign(this.empresa_sucursal.tempAttributes ,this.empresa_sucursal.attributes);
                    this.empresa_sucursal.attributes = new Object({
                        id_sucursal:null,
                        nombre:'',
                        casa_matriz:0,
                        direccion:'',
                        telefono:'',
                        fecha_apertura:'',
                        estatus:'',
                        id_ciudad:'',
                        ciudad:'',
                        id_empresa:'',
                    });
                    this.empresa_sucursal.tempAttributes = new Object({
                        id_sucursal:null,
                        nombre:'',
                        casa_matriz:0,
                        direccion:'',
                        telefono:'',
                        fecha_apertura:'',
                        estatus:'',
                        id_ciudad:'',
                        ciudad:'',
                        id_empresa:'',
                    });
                    this.cancelModeEditEmpresaSucursal();
                    this.notificationSuccess();
                }).catch(errors => {
                this.notificationErrors(errors);
            });
        },

        findSucursales(id_empresa){
            for(indexEmpresa in this.empresa.data){
                if(this.empresa.data[indexEmpresa].id_empresa===id_empresa){
                    this.empresa_sucursal.sucursales = this.empresa.data[indexEmpresa].sucursales;
                    break;
                }
            }
        },
        seeSucursalesOfEmpresa(empresa) {
            this.empresa.oneEmpresa=empresa;
            this.empresa_sucursal.sucursales = empresa.sucursales;
            this.empresa_sucursal.attributes.id_empresa = empresa.id_empresa;
        },
        changeModeEditEmpresaSucursal(sucursal){
            console.log(sucursal);
            this.empresa_sucursal.tempAttributes = sucursal;
            this.empresa_sucursal.attributes = Object.assign({}, sucursal);
            this.empresa_sucursal.modeEdit = true;
            this.empresa_sucursal.modeCreate = true;
        },
        cancelModeEditEmpresaSucursal(){
            this.empresa_sucursal.hideSuggestions = true;
            setTimeout(()=>{
                this.empresa_sucursal.hideSuggestions = false;
            },1);
            this.empresa_sucursal.attributes = new Object({
                id_sucursal:null,
                nombre:'',
                casa_matriz:0,
                direccion:'',
                telefono:'',
                fecha_apertura:'',
                estatus:'',
                id_ciudad:'',
                ciudad:'',
                id_empresa:'',
            });
            this.empresa_sucursal.tempAttributes = new Object({
                id_sucursal:null,
                nombre:'',
                casa_matriz:0,
                direccion:'',
                telefono:'',
                fecha_apertura:'',
                estatus:'',
                id_ciudad:'',
                ciudad:'',
                id_empresa:'',
            });
            this.empresa_sucursal.modeEdit = false;
            this.empresa_sucursal.modeCreate = false;
        },
        assignAnIdentificationToTheSucursal(response) {
            if (response && response.id_ciudad) {
                this.empresa_sucursal.attributes.id_ciudad = response.id_ciudad;
                this.empresa_sucursal.attributes.ciudad = response;
            } else {
                this.empresa_sucursal.attributes.id_ciudad = null;
                this.empresa_sucursal.attributes.ciudad = {
                    id_ciudad:null,
                    nombre:'',
                    pais_ciudad:''
                };
            }
        },
        //</editor-fold>

        //<editor-fold desc="Methods of Almacen">
        submitFormAlmacen() {
            if (!this.almacen.attributes.id_sucursal) {
                this.registerAlmacen();
            } else {
                this.updateAlmacen();
            }
        },

        getAlmacen(){
            axios.get(urlGlobal.resourcesAlmacen
            ).then(response => {
                this.almacen.data = response.data;
            }).catch(errors => {
                console.log('errors');
            });
        },

        registerAlmacen(){
            let inputs = Object.assign({}, this.almacen.attributes);
            axios.post(urlGlobal.resourcesAlmacen, inputs
            ).then(response => {
                this.almacen.attributes = new Object({
                    id_almacen:null,
                    codigo: '',
                    direccion: '',
                    id_sucursal: null,
                });
                this.almacen.hideSuggestions = true;
                setTimeout(()=>{
                    this.almacen.hideSuggestions = false;
                },1);
                this.getAlmacen();
                this.notificationSuccess();
            }).catch(errors => {
                console.log('errors');
                this.notificationErrors(errors);
            });
        },

        updateAlmacen(){
            let inputs = Object.assign({},this.almacen.attributes);
            axios.put(urlGlobal.resourcesAlmacen + '/'+ inputs.id_almacen, inputs)
                .then(response => {
                    Object.assign(this.almacen.tempAttributes ,this.almacen.attributes);
                    this.almacen.attributes = new Object({
                        id_almacen:null,
                        codigo: '',
                        direccion: '',
                        id_sucursal: null,
                    });
                    this.almacen.tempAttributes = new Object({
                        id_almacen:null,
                        codigo: '',
                        direccion: '',
                        id_sucursal: null,
                    });
                    this.cancelModeEditAlmacen();
                    this.notificationSuccess();
                }).catch(errors => {
                this.notificationErrors(errors);
            });
        },

        modeEditAlmacen(almacen) {
            this.almacen.tempAttributes = almacen;
            this.almacen.attributes = Object.assign({}, almacen);
        },

        cancelModeEditAlmacen(){
            $("#modal-edit-almacen").modal('hide');
            this.almacen.attributes = new Object({
                id_almacen:null,
                codigo: '',
                direccion: '',
                id_sucursal: null,
            });
            this.almacen.tempAttributes = new Object({
                id_almacen:null,
                codigo: '',
                direccion: '',
                id_sucursal: null,
            });
        },

        getSucursalesAlmacen() {
            axios.get(urlGlobal.resourcesSucursal
            ).then(response => {
                this.almacen.sucursales = response.data;
            }).catch(errors => {
                console.log('errors');
            });
        },
        //</editor-fold>


        //<editor-fold desc="Methods of Empleado">
        submitFormEmpleado() {
            if (!this.empleado.attributes.id_empleado) {
                this.registerEmpleado();
            } else {
                this.updateEmpleado();
            }
        },

        getEmpleados() {
            axios.get(urlGlobal.resourcesEmpleado
            ).then(response => {
                this.empleado.data = response.data;
            }).catch(errors => {
                console.log('errors');
            });
        },

        handleFileUpload(event){
            this.empleado.attributes.foto = event.target.files[0];
        },
        registerEmpleado(){
            let inputs = Object.assign({}, this.empleado.attributes);
            let formData = new FormData();
            formData.append('foto', inputs.foto);
            delete inputs.foto;
            formData.append('data', JSON.stringify(inputs) );
            axios.post( urlGlobal.resourcesEmpleado, formData/*,
                formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }*/
            ).then( response => {
                this.empleado.attributes = {
                    id_empleado:null,
                    nombre:'',
                    ci:'',
                    sexo:'',
                    fecha_nacimiento:null,
                    telefono:null,
                    celular:null,
                    correo:null,
                    direccion:'',
                    foto:null,
                    persona_referencia:'',
                    telefono_referencia:'',
                    fecha_registro:null,
                    estatus:'',
                    id_sucursal:null,
                    kardex:{
                        id_kardex:null,
                        id_cargo:null,
                        fecha_inicio:null,
                        salario:{
                            monto:null,
                            id_moneda:null
                        }
                    }
                };
                this.empleado.hideSuggestions = true;
                this.getEmpleados();
                this.notificationSuccess();
                setTimeout(()=>{
                    this.empleado.hideSuggestions = false;
                },1);

            }).catch( errors => {
                console.log('FAILURE!!');
                this.notificationErrors(errors);
            });
        },

        updateEmpleado(){

            let inputs = Object.assign({},this.empleado.attributes);
            let formData = new FormData();
            formData.append('foto', inputs.foto);
            delete inputs.foto;
            formData.append('data', JSON.stringify(inputs) );
            formData.append('_method', 'PUT');
            axios.post(urlGlobal.resourcesEmpleado+ '/' + inputs.id_empleado, formData,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }
            ).then(response => {
                Object.assign(this.empleado.tempAttributes, this.empleado.attributes);
                this.empleado.attributes = new Object({
                    id_empleado: null,
                    nombre: '',
                    ci: '',
                    sexo: '',
                    fecha_nacimiento: '',
                    telefono: null,
                    celular: null,
                    correo: '',
                    direccion: '',
                    foto: null,
                    persona_referencia: '',
                    telefono_referencia: '',
                    fecha_registro: null,
                    status: '',
                    id_sucursal: null,
                    kardex: {
                        id_kardex: null,
                        id_cargo: null,
                        fecha_inicio: '',
                        salario: {
                            monto: null,
                            id_moneda: null
                        }
                    }
                });
                this.empleado.tempAttributes = new Object({
                    id_empleado: null,
                    nombre: '',
                    ci: '',
                    sexo: '',
                    fecha_nacimiento: '',
                    telefono: null,
                    celular: null,
                    correo: '',
                    direccion: '',
                    foto: null,
                    persona_referencia: '',
                    telefono_referencia: '',
                    fecha_registro: null,
                    status: '',
                    id_sucursal: null,
                    kardex: {
                        id_kardex: null,
                        id_cargo: null,
                        fecha_inicio: '',
                        salario: {
                            monto: null,
                            id_moneda: null
                        }
                    }
                });
                this.cancelModeEditEmpleado();
                this.notificationSuccess();
            }).catch(errors => {
                this.notificationErrors(errors);
            });
        },
        changeStatusEmpleado(empleado){
            let confirmResponse = confirm('¿Está seguro?');
            if(confirmResponse){
                axios.patch(urlGlobal.changeStatusEmpleado+empleado.id_empleado
                ).then(response => {
                    empleado.estatus= Number(empleado.estatus)===1 ? 0:1;
                    this.notificationSuccess();
                }).catch(errors => {
                    this.notificationErrors(errors);
                });
            }
        },

        modeEditEmpleado(empleado) {
            this.empleado.tempAttributes = empleado;
            this.empleado.attributes = Object.assign({}, empleado);
        },
        cancelModeEditEmpleado(){
            $("#modal-edit-empleado").modal('hide');
            this.empleado.attributes = new Object({
                id_empleado:null,
                nombre:'',
                ci:'',
                sexo:'',
                fecha_nacimiento:null,
                telefono:null,
                celular:null,
                correo:null,
                direccion:'',
                foto:null,
                persona_referencia:'',
                telefono_referencia:'',
                fecha_registro:null,
                estatus:'',
                id_sucursal:null,
                kardex:{
                    id_kardex:null,
                    id_cargo:null,
                    fecha_inicio:null,
                    salario:{
                        monto:null,
                        id_moneda:null
                    }
                }
            });
            this.empleado.tempAttributes = new Object({
                id_empleado:null,
                nombre:'',
                ci:'',
                sexo:'',
                fecha_nacimiento:null,
                telefono:null,
                celular:null,
                correo:null,
                direccion:'',
                foto:null,
                persona_referencia:'',
                telefono_referencia:'',
                fecha_registro:null,
                estatus:'',
                id_sucursal:null,
                kardex:{
                    id_kardex:null,
                    id_cargo:null,
                    fecha_inicio:null,
                    salario:{
                        monto:null,
                        id_moneda:null
                    }
                }
            });
        },
        //</editor-fold>

        //<editor-fold desc="Methods of Kardex and Observaciones">
        getKardexOfEmpleado(empleado) {
            this.kardex.empleado=empleado;
            this.kardex.attributes = Object.assign({}, this.kardex.model);
            this.kardex.attributes.id_empleado = empleado.id_empleado;
            this.getKardex(empleado.id_empleado);
        },
        registerKardex(){
            axios.post(urlGlobal.resourcesKardex,this.kardex.attributes
            ).then(response => {
                let id_empleado=this.kardex.attributes.id_empleado;
                this.kardex.attributes=Object.assign({},this.kardex.model);
                this.kardex.attributes.id_empleado=id_empleado;
                this.kardex.empleado.estatus=1;
                this.getKardex(id_empleado);
                this.notificationSuccess();
            }).catch(errors => {
                console.log('errors');
                this.notificationErrors();
            });
        },
        submitFormKardex(){
            if (!this.kardex.attributes.id_kardex) {
                this.registerKardex();
            } else {
                this.updateKardex();
            }
        },
        updateKardex(){
            axios.put(urlGlobal.resourcesKardex+'/'+this.kardex.attributes.id_kardex,this.kardex.attributes
            ).then(response => {
                let id_empleado=this.kardex.attributes.id_empleado;
                this.kardex.attributes=Object.assign({},this.kardex.model);
                this.kardex.attributes.id_empleado=id_empleado;
                this.getKardex(id_empleado);
                this.notificationSuccess();
            }).catch(errors => {
                console.log('errors');
                this.notificationErrors();
            });
        },
        editKardex(kardex){
            Object.assign(this.kardex.attributes, kardex);
            this.kardex.attributes.salario=kardex.salario.monto;
        },
        cancelEditKardex(){
            let id_empleado=this.kardex.attributes.id_empleado;
            this.kardex.attributes=Object.assign({},this.kardex.model);
            this.kardex.attributes.id_empleado=id_empleado;
        },
        getKardex(id_empleado){
            axios.get(urlGlobal.getKardex+id_empleado
            ).then(response => {
                this.kardex.data = response.data;
            }).catch(errors => {
                console.log('errors');
            });
        },
        getKardexObservacionesOfServer() {
            axios.get(urlGlobal.resourcesKardexObservaciones+'/'+this.kardex
                .kardex_observaciones.attributes.id_kardex
            ).then(response => {
                this.kardex.kardex_observaciones.data=response.data;
            }).catch(errors => {
                console.log('errors');
            });
        },
        getKardexObservaciones(observaciones,id_kardex){
            this.kardex.kardex_observaciones.data=observaciones;
            this.kardex.kardex_observaciones.attributes.id_kardex=id_kardex;
            this.changeTab(11);
        },

        registerKardexObservacion(){
            let inputs = Object.assign({}, this.kardex.kardex_observaciones.attributes);
            axios.post( urlGlobal.resourcesKardexObservaciones,inputs
            ).then( response => {
                this.kardex.kardex_observaciones.attributes.id_kardex_observacion =null;
                this.kardex.kardex_observaciones.attributes.observacion = '';
                this.getKardexObservacionesOfServer();
                this.notificationSuccess();
            }).catch( errors => {
                console.log('FAILURE!!');
                this.notificationErrors(errors);
            });
        },

        modeEditKardexObserbacion(kardex_observacion) {
            this.kardex.kardex_observaciones.tempAttributes = kardex_observacion;
            this.kardex.kardex_observaciones.attributes = Object.assign({}, kardex_observacion);
        },
        cancelModeEditKardexObserbacion(){
            let id_kardex = this.kardex.kardex_observaciones.attributes.id_kardex;
            this.kardex.kardex_observaciones.attributes = new Object({
                id_kardex_observacion:null,
                id_kardex:null,
                observacion:''
            });
            this.kardex.kardex_observaciones.attributes.id_kardex = id_kardex;
            this.kardex.kardex_observaciones.tempAttributes = new Object({
                id_kardex_observacion:null,
                id_kardex:null,
                observacion:''
            });
        },

        updateKardexObservaciones(){
            let inputs = Object.assign({}, this.kardex.kardex_observaciones.attributes);
            axios.put(urlGlobal.resourcesKardexObservaciones+ '/' + inputs.id_kardex_observaciones,
            inputs
            ).then(response => {
                Object.assign(this.kardex.kardex_observaciones.tempAttributes,
                    this.kardex.kardex_observaciones.attributes);
                this.cancelModeEditKardexObserbacion();
                this.notificationSuccess();
            }).catch(errors => {
                this.notificationErrors(errors);
            });
        },
        submitFormKardexObservaciones() {
            if (!this.kardex.kardex_observaciones.attributes.id_kardex_observaciones) {
                this.registerKardexObservacion();
            } else {
                this.updateKardexObservaciones();
            }
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
        deleteKardexObservaciones(id, index){
            let r = confirm("ESTÁ SEGURO");
            if (r === true) {
                axios.delete(urlGlobal.resourcesKardexObservaciones+ '/' + id
                ).then(response => {
                    this.kardex.kardex_observaciones.data.splice(index,1);
                    this.notificationSuccess();
                }).catch(errors => {
                    console.log('errors');
                    this.notificationErrors(errors);
                });
            }
        },
        forceClosedModelKardex() {
            this.kardex.kardex_observaciones.attributes.id_kardex = null;
            this.kardex.currentTab = 10;
            this.kardex.kardex_observaciones.attributes = new Object({
                id_kardex_observacion:null,
                id_kardex:null,
                observacion:''
            });
            this.kardex.kardex_observaciones.tempAttributes = new Object({
                id_kardex_observacion:null,
                id_kardex:null,
                observacion:''
            });
        },
        //</editor-fold>

        getPermisos() {
            axios.get(urlGlobal.getPermisos
            ).then(response => {
                let permisos=[];
                response.data.forEach(value=>{
                    value.permitir = 0;
                    permisos.push(value);
                });
                this.acceso.permisos = permisos;
            }).catch(errors => {
                console.log('errors');
            });
        },

        getAccesoOfEmpleadoServer(empleado) {
            axios.get(urlGlobal.resourcesAcceso+'/'+empleado.id_empleado
            ).then(response => {
                if (response.data.id_empleado) {
                    this.acceso.attributes.usuario = response.data.usuario;
                    this.acceso.attributes.pass = '';
                    this.acceso.attributes.id_empleado = response.data.id_empleado;
                    response.data.permiso.forEach(_permiso=>{
                        this.acceso.permisos.forEach(permisos_disponibles =>{
                            if (permisos_disponibles.id_permiso === _permiso.id_permiso) {
                                permisos_disponibles.permitir = 1;
                            }
                        });
                    });
                } else {
                    this.acceso.permisos.forEach(permisos_disponibles =>{
                        permisos_disponibles.permitir = 0;
                    });
                    this.acceso.attributes.usuario = '';
                    this.acceso.attributes.id_empleado = null;
                }
                // this.acceso.permisos = permisos;
            }).catch(errors => {
                console.log('errors');
            });
        },

        submitFormAcceso() {
            if (!this.acceso.attributes.id_empleado) {
                this.registerAcceso();
            } else {
                this.updateAcceso();
            }
        },
        registerAcceso(){
            let inputs = Object.assign({}, this.acceso.attributes);
            inputs.id_empleado = this.acceso.empleado.id_empleado;
            inputs.permisos_permitidos = this.acceso.permisos;
            axios.post( urlGlobal.resourcesAcceso,inputs
            ).then( response => {
                this.acceso.attributes.id_empleado = inputs.id_empleado
                /*this.kardex.kardex_observaciones.attributes.id_kardex_observacion =null;
                this.kardex.kardex_observaciones.attributes.observacion = '';
                this.getKardexObservacionesOfServer();*/
                this.notificationSuccess();
            }).catch( errors => {
                console.log('FAILURE!!');
                this.notificationErrors(errors);
            });
        },
        updateAcceso(){
            let inputs = Object.assign({}, this.acceso.attributes);
            inputs.id_empleado = this.acceso.empleado.id_empleado;
            inputs.permisos_permitidos = this.acceso.permisos;
            axios.put( urlGlobal.resourcesAcceso +'/'+ inputs.id_empleado ,inputs
            ).then( response => {
                this.notificationSuccess();
            }).catch( errors => {
                console.log('FAILURE!!');
                this.notificationErrors(errors);
            });
        },
        getAccesoOf(empleado){
            this.acceso.permisos.forEach(permisos_disponibles =>{
                permisos_disponibles.permitir = 0;
            });
            this.getAccesoOfEmpleadoServer(empleado);
            this.acceso.empleado.id_empleado=empleado.id_empleado;
            this.acceso.empleado.nombre=empleado.nombre;
        },
        // 1: para permitir; 0: para no permitir
        changePermisos(selectValue) {
            this.acceso.permisos.forEach(permiso => {
                permiso.permitir = selectValue;
            });
        },





        changeTab(tab) {
            this.kardex.currentTab=tab;
        },
        //<editor-fold desc="Methods Notificacion">
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