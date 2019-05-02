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
            modeEdit:false,
            modeCreate:false,
            title:'',
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
        },
        monedas: [],
        almacenes: [],
        compra: {
            /*config:{
                url:urlGlobal.suggestionsOfCiudades,
                placeholder:'Buscar por nombre de Ciudad',
                variableForSuggestions:'pais_ciudad',
                variableForSuggestionsId:'id_ciudad'
            },*/
            paginated: {
                size: 15,
                pageNumber: 0,
            },
            filters:{
              empleado:'',
              almacen:'',
              proveedor:''
            },
            credito:{
                id:null,
                monto:null,
                observaciones:'',
                tipo_pago:'ef',
                id_compra:null

            },
            modelcredito:{
                id:null,
                monto:null,
                observaciones:'',
                tipo_pago:'ef',
                id_compra:null

            },
            compra_credito_data:[],
            compra_credito_total:0,
            hideSuggestions:false,
            hideFilters:false,
            hideSuggestionsArticulo:false,
            data: [],
            data_with_filters: [],
            articulo:{
                categoria:{
                    categoria:''
                },
                fabricante:{
                    nombre:''
                },
                stock:null
            },
            detalleCompra:{
                cantidad:number=null,
                precio_unitario:null,
                id_articulo:null,
                id_almacen:null,
                subtotal:null,
                nombre: '',
            },
            detallesCompra:[],
            one:null,
            tempDetalleCompra:{
                cantidad:number=null,
                precio_unitario:null,
                id_articulo:null,
                id_almacen:null,
                subtotal:null,
                nombre: '',
            },
            totalDetallesCompra:0,
            almacenSelected:null,
            attributes: {
                id_compra: null,
                fecha: '',
                descuento: null,
                costo_total: '',
                codigo_tarjeta_cheque: '',
                nro_factura: '',
                observaciones: '',
                estatus: '',
                id_moneda: null,
                id_empleado: null,
                id_proveedor: null,
                proveedor: {
                    id_proveedor: null,
                    razon_social:''
                },
                detalles_compra:[],
                tipo_pago: 'ef'
            },
            tempAttributes: {
                id_compra: null,
                fecha: '',
                descuento: '',
                costo_total: '',
                codigo_tarjeta_cheque: '',
                nro_factura: '',
                observaciones: '',
                estatus: '',
                id_moneda: null,
                id_empleado: null,
                id_proveedor: null,
                proveedor: {
                    id_proveedor: null,
                    razon_social:''
                },
                tipo_pago: 'ef',
            },
            /*model: {
                id_compra: null,
                fecha: '',
                descuento: '',
                costo_total: '',
                codigo_tarjeta_cheque: '',
                nro_factura: '',
                observaciones: '',
                estatus: '',
                id_moneda: null,
                id_empleado: null,
                id_contacto: null,
                tipo_pago: ''
            },*/
        },
        configProveedor:{
            url:urlGlobal.suggestionsOfProveedores,
            placeholder:'Nombre del proveedor',
            variableForSuggestions:'razon_social',
            variableForSuggestionsId:'id_proveedor'
        },
        configArticulo:{
            url:urlGlobal.getArticuloForName,
            placeholder:'Nombre del Artículo',
            variableForSuggestions:'nombre',
            variableForSuggestionsId:'id_articulo'
        },
        configEmpleado:{
            url:urlGlobal.simpleSuggestionsEmpleados,
            placeholder:'Nombre del Empleado',
            variableForSuggestions:'nombre',
            variableForSuggestionsId:'id_empleado'
        },
    },
    mounted() {
        this.getProveedores();
        this.getMonedas();
        this.getCargos();
        this.getAlmacenes();
        this.compra.attributes.fecha=this.dateNow();
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
        submitFormCuentaProveedor: function(){
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
                    this.cancelModeEditCuentaProveedor();
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
                    this.monedas = response.data;
                    this.monedas.forEach(moneda=>{
                        if(moneda.nombre==='Bolivianos' || moneda.nombre==='bolivianos'){
                            this.compra.attributes.id_moneda = moneda.id_moneda;
                        }
                    });
                }).catch(errors => {
                console.log('errors');
            });
        },
        cancelModeEditCuentaProveedor: function() {
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
                axios.delete(urlGlobal.resourcesCuentaProveedor + '/' + id
                ).then(response => {
                    this.cuenta_proveedor.cuentas.splice(index, 1);
                }).catch((errors) => {
                    console.log(errors);
                });
            }
        },
        //</editor-fold>

        //<editor-fold desc="Methods of Contacto">
        getCargos: function(){
            axios.get(urlGlobal.resourcesCargo)
                .then(response => {
                    this.contacto.cargos = response.data;
                }).catch(errors => {
                console.log('errors');
            });
        },
        getContactoProveedor(proveedor){
            this.contacto.attributes.id_proveedor=proveedor.id_proveedor;
            this.contacto.title = proveedor.razon_social;
            this.getContactoProveedorById(proveedor.id_proveedor);
        },
        getContactoProveedorById: function(id_proveedor){
            axios.get(urlGlobal.getContactoOfProveedor+id_proveedor)
                .then(response => {
                    this.contacto.data = response.data;
                }).catch(errors => {
                console.log('errors');
            });
        },
        changeModeEditContactoProveedor: function(contacto){
            this.contacto.tempAttributes = contacto;
            this.contacto.attributes = Object.assign({}, contacto);
            this.contacto.modeEdit = true;
            this.contacto.modeCreate = true;
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
            if (!this.contacto.attributes.id_contacto) {
                this.registerContacto();
            } else {
                this.updateContacto();
            }
        },

        registerContacto: function() {
            let input = Object.assign({},this.contacto.attributes);
            axios.post(urlGlobal.resourcesContacto, input)
                .then(response => {
                    this.getContactoProveedorById(input.id_proveedor);
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
                    this.contacto.id_proveedor= input.id_proveedor;
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
        updateContacto:function () {
            let inputs = Object.assign({},this.contacto.attributes);
            axios.put(urlGlobal.resourcesContacto + '/' + inputs.id_contacto, inputs)
                .then(response => {
                    Object.assign(this.contacto.tempAttributes ,this.contacto.attributes);
                    this.cancelModeEditContacto();
                    this.notificationSuccess();
                }).catch(errors => {
                this.notificationErrors(errors);
            });
        },

        modeEditContactoProveedor: function(contacto) {
            this.contacto.tempAttributes = contacto;
            this.contacto.attributes = Object.assign({}, contacto);
        },
        cancelModeEditContacto: function() {
            this.contacto.attributes = new Object({
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
            });
            this.contacto.tempAttributes = new Object({
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
            });
            this.contacto.hideSuggestions = true;
            this.contacto.modeCreate = false;
            this.contacto.modeEdit = false;
            /*setTimeout(()=>{
                this.contacto.hideSuggestions = false;
            },1);
            $('#modal-edit-contacto').modal('hide');*/
        },
        //</editor-fold>

        //<editor-fold desc="Methods of Comprar">
        assignAnIdentificationToProveedor(response){
            if (response && response.id_proveedor) {
                this.compra.attributes.id_proveedor = response.id_proveedor;
                this.compra.attributes.proveedor = response;
            } else {
                this.compra.attributes.id_proveedor = null;
                this.compra.attributes.proveedor = {
                    id_proveedor:null,
                    razon_social:''
                };
            }
        },
        assignAnIdentificationOfArticuloToDetalleCompra(response) {
            if (response && response.id_articulo) {
                this.compra.detalleCompra.id_articulo = response.id_articulo;
                this.compra.detalleCompra.nombre = response.nombre;
                this.compra.articulo = response;
                this.$refs.input_articulo_codigo.value = response.codigo;
                this.$refs.input_articulo_codigo_barra.value = response.codigo_barra;
                this.$refs.txtCantidad.select();
            } else {
                this.compra.detalleCompra.id_articulo = null;
                this.compra.detalleCompra.nombre = '';
            }
        },
        getAlmacenes: function(){
            axios.get(urlGlobal.resourcesAlmacen)
                .then(response => {
                    this.almacenes = response.data;
                }).catch(errors => {
                console.log('errors');
            });
        },
        getArticuloByCodigoBarras: function(codigoBarras) {
            if (!codigoBarras.target.value.length <= 0) {
                axios.get(urlGlobal.getArticuloForCodigoBarras + codigoBarras.target.value
                ).then(response => {
                    if( Object.keys(response.data).length === 0){
                        this.compra.detalleCompra.id_articulo = null;
                        this.compra.detalleCompra.nombre = '';
                    } else {
                        this.compra.detalleCompra.id_articulo = response.data[0].id_articulo;
                        this.compra.detalleCompra.nombre = response.data[0].nombre;
                        this.compra.articulo = response.data[0];
                        this.compra.tempDetalleCompra.nombre = response.data[0].nombre;
                        this.$refs.input_articulo_codigo.value = response.data[0].codigo;
                        this.$refs.txtCantidad.select();
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
                        this.compra.detalleCompra.id_articulo = null;
                        this.compra.detalleCompra.nombre = '';
                    } else {
                        this.compra.detalleCompra.id_articulo = response.data[0].id_articulo;
                        this.compra.detalleCompra.nombre = response.data[0].nombre;
                        this.compra.tempDetalleCompra.nombre = response.data[0].nombre;
                        this.compra.articulo = response.data[0];
                        this.$refs.input_articulo_codigo_barra.value = response.data[0].codigo_barra;
                        this.$refs.txtCantidad.select();
                    }
                }).catch(errors => {
                    console.log(errors);
                });
            }
        },
        getComprasByRageDate(event){
            axios.post(urlGlobal.getComprasByRageDate, event
            ).then(response => {
                this.compra.data = response.data;
                this.compra.data_with_filters = this.compra.data;
                this.compra.paginated.pageNumber = 0;
            }).catch(errors => {
                console.log(errors);
            });
        },
        assignAnIdentificationOfCompraToCredito(compra){
            Object.assign(this.compra.credito, this.compra.modelcredito);
            this.compra.credito.id_compra = compra.id_compra;
            this.compra.tempAttributes = compra;
            this.compra.compra_credito_total=0;
            this.getCompraCredito(compra.id_compra);
        },
        getCompraCredito(id){
            axios.get(urlGlobal.getCompraCredito+id
            ).then(response => {
                this.compra.compra_credito_data=response.data;
                response.data.forEach(value=> this.compra.compra_credito_total+= parseFloat(value.monto));
            }).catch(errors => {
                console.log(errors);
            });
        },
        registerCompraCredito: function() {
            let inputs = this.compra.credito;
            axios.post(urlGlobal.postCompraCredito, inputs)
                .then(response => {
                    let id_compra = this.compra.credito.id_compra;
                    let tipo_pago = this.compra.credito.tipo_pago;
                    Object.assign(this.compra.credito, this.compra.modelcredito);
                    this.compra.credito.id_compra = id_compra;
                    this.compra.credito.tipo_pago =tipo_pago;
                    this.notificationSuccess();
                }).catch(errors => {
                console.log('errors');
                this.notificationErrors2(errors);
            });

        },

        addDetalleCompra(){
            if( this.compra.detalleCompra.cantidad
                && this.compra.detalleCompra.precio_unitario
                && this.compra.detalleCompra.id_articulo
            ){
                let index = this.compra.attributes.detalles_compra.findIndex
                (detalle => {
                    return detalle.id_articulo === this.compra.detalleCompra.id_articulo;
                });
                if (index === -1) {
                    this.compra.attributes.detalles_compra.push(this.compra.detalleCompra);
                } else {
                    let detalles_compra = this.compra.attributes.detalles_compra[index];
                    detalles_compra.cantidad += this.compra.detalleCompra.cantidad;
                }

                this.calcularTotale();
                this.compra.articulo.categoria.categoria ='';
                this.compra.articulo.fabricante.nombre ='';
                this.compra.articulo.stock = null;
                this.compra.detalleCompra = {
                    cantidad:null,
                    precio_unitario:null,
                    id_articulo:null,
                    subtotal:null,
                    nombre: '',
                };
                this.compra.hideSuggestionsArticulo = true;
                setTimeout(()=>{this.compra.hideSuggestionsArticulo = false;},1);
            } else {
                let errors=[
                  '<li>El Árticulo es requerido</li>',
                  '<li>El precio unitario es requerido</li>',
                  '<li>La cantidad es requerida</li>',
                ];
                toastr.error(errors, 'Revice los campos', {timeOut: 10000});
            }
        },
        removeDetalleCompra(index){
            this.compra.attributes.detalles_compra.splice(index, 1);
            this.calcularTotale();
        },
        calcularTotale(){
            let total = 0;
            this.compra.attributes.detalles_compra.forEach(detalle => {
                let subtotal = 0;
                subtotal = detalle.cantidad * detalle.precio_unitario;
                detalle.subtotal = subtotal;
                total += subtotal;
            });
            this.compra.totalDetallesCompra = total - this.compra.attributes.descuento;
        },
        submitFormCompra(){
            let inputs = Object.assign({}, this.compra.attributes);
            inputs.detalles_compra.forEach( detalle => {
               detalle.id_almacen = this.compra.almacenSelected
            });
            delete inputs.proveedor;
            axios.post(urlGlobal.resourcesCompra, inputs)
                .then(response => {
                    this.compra.attributes.detalles_compra=[];
                    this.compra.totalDetallesCompra=0;
                    this.notificationSuccess();
                }).catch(errors => {
                console.log('errors');
                this.notificationErrors(errors);
            });
        },
        focusButtonYes(){
            setTimeout(()=>{
                document.activeElement.blur();
                this.$refs.btnSi.focus();
            },350);
        },
        purchaseArrived(compra){
            let _confirm = confirm('¿Está seguro?');
            if(_confirm){
                axios.patch(urlGlobal.purchaseArrived+compra.id_compra
                ).then(response => {
                    compra.llego=1;
                    compra.fecha_llegada=this.toDateTimeLocal(new Date());
                }).catch(errors => {
                    console.log(errors);
                });
            }
        },
        getPurchasesOnCreditInForce(){
            axios.get(urlGlobal.getPurchasesOnCreditInForce
            ).then(response => {
                this.compra.data = response.data;
                this.compra.data_with_filters = this.compra.data;
                this.compra.paginated.pageNumber = 0;
            }).catch(errors => {
                console.log(errors);
            });
        },
        //</editor-fold>

        //<editor-fold desc="Methods paginated">
        nextPage(){
            this.compra.paginated.pageNumber++;
        },
        prevPage(){
            this.compra.paginated.pageNumber--;
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

        //<editor-fold desc="Methods of Filters">
        filterByEmpleado(empleado){
            if(empleado && empleado.nombre) {
                this.compra.filters.empleado = empleado.nombre;
                this.goThroughFilters();
            }
        },
        filterByAlmacen: function(almacen){
            if(almacen.target.options.selectedIndex > -1) {
                let index = almacen.target.options.selectedIndex;
                this.compra.filters.almacen = almacen.target.options[index].text;
                this.goThroughFilters();
            }
        },
        filterByProveedor: function(proveedor){
            if(proveedor && proveedor.razon_social) {
                this.compra.filters.proveedor = proveedor.razon_social;
                this.goThroughFilters();
            }
        },

        removeFilters(){
            this.compra.filters.proveedor='';
            this.compra.filters.almacen='';
            this.compra.filters.empleado='';
            this.compra.hideFilters = true;
            this.compra.paginated.pageNumber = 0;
            setTimeout(()=>this.compra.hideFilters = false,1);
            this.goThroughFilters();
        },
        viewDetallesCompra(detalle){
            this.compra.detallesCompra = detalle.detalle_compra;
        },
        printDetalleOfCompra(compra){
            this.compra.one=compra;
            this.$nextTick(function () {
                this.print(this.$refs.print_compra);
            });
        },
        goThroughFilters(){
            let filtered_data = this.compra.data;
            if(this.compra.filters.empleado.length>0){
                filtered_data = filtered_data.filter( _empleado =>{
                    return _empleado.empleado === this.compra.filters.empleado;
                });
            }
            if(this.compra.filters.almacen.length>0){
                filtered_data = filtered_data.filter( _almacen =>{
                    return _almacen.almacen === this.compra.filters.almacen;
                });
            }
            if(this.compra.filters.proveedor.length>0){
                filtered_data = filtered_data.filter( _proveedor =>{
                    return _proveedor.proveedor === this.compra.filters.proveedor;
                });
            }
            this.compra.paginated.pageNumber = 0;
            this.compra.data_with_filters=filtered_data;
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
        toDateTimeLocal(datetime) {
            let _datetime = datetime;
            ten = function (i) {
                return (i < 10 ? '0' : '') + i;
            };
            let YYYY = _datetime.getFullYear();
            let MM = ten(_datetime.getMonth() + 1);
            let DD = ten(_datetime.getDate());
            let HH = ten(_datetime.getHours());
            let II = ten(_datetime.getMinutes());
            let SS = ten(_datetime.getSeconds());
            return YYYY + '-' + MM + '-' + DD + ' ' +
                HH + ':' + II + ':' + SS;
        },
        dateNow(){
            let today = new Date();
            console.log(today);
            let dd = today.getDate();
            let mm = today.getMonth() + 1; //January is 0!
            let yyyy = today.getFullYear();

            if (dd < 10) {
                dd = '0' + dd;
            }

            if (mm < 10) {
                mm = '0' + mm;
            }

            return today = yyyy + '-' + mm + '-' + dd;
        },
        print(element) {
            let domClone = element.cloneNode(true);
            let printSection = document.getElementById("printSection");
            if (!printSection) {
                let printSection = document.createElement("div");
                printSection.class = "printSection";
                document.body.appendChild(printSection);
            }
            printSection.innerHTML = "";
            printSection.appendChild(domClone);
            window.print();
        },
        exportPdf() {
            const doc = new jsPDF('l','mm', 'letter', true);
            doc.autoTable({html: '#content'});
            doc.save('table.pdf');
        }
    },
    computed: {
        pageCount: function(){
            let l = this.compra.data_with_filters.length,
                s = this.compra.paginated.size;
            return Math.ceil(l/s);
        },
        paginatedData: function(){
            const start = this.compra.paginated.pageNumber * this.compra.paginated.size,
                end = start + this.compra.paginated.size;
            return this.compra.data_with_filters
                .slice(start, end);
        }
    }
});