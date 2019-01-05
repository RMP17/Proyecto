var appCompra = new Vue({
    el: '#app-compra',
    data: {
        proveedor: {
            config:{
                url:urlGlobal.getPaisesByName,
                placeholder:'Buscar por nombre de Pais',
                variableForSuggestions:'nombre',
                variableForSuggestionsId:'id_pais'
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
                ciudad: '',
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
                ciudad: '',
                id_ciudad: ''
            }
        },
    },
    methods: {
        submitFormProveedor() {
            if (!this.proveedor.attributes.id_proveedor) {
                this.registerProveedor();
            } else {
                this.updateProveedor();
            }
        },
        registerProveedor() {
            let input = this.proveedor.attributes;
            axios.post(urlGlobal.resourcesproveedor, input)
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
                        ciudad: '',
                        id_ciudad: ''
                    };
                    this.notificationSuccess();
                }).catch(errors => {
                console.log('errors');
                this.notificationErrors(errors);
            });

        },
        updateProveedor() {

        },
        getProveedor(){

        }
    }

});