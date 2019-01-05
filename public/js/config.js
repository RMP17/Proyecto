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
            ciudad:''
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
        }
    },
    mounted(){
        this.getMonedas();
        this.getCargo();
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
        addCiudadToPais(pais) {
            console.log(pais);
            axios.post(urlGlobal.addCiudadToPais + pais.id_pais, {nombre: this.pais.ciudad}
            ).then(response => {
                pais.ciudades.push({nombre: this.pais.ciudad});
                this.pais.ciudad = '';
            }).catch(errors => {
                console.log(errors);
            });

        },
        modeEditPais(pais) {
            this.pais.tempAttributes = pais;
            this.pais.attributes = Object.assign({}, pais);
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
    }
});