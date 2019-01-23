var appCompra = new Vue({
    el: '#app-caja',
    data: {
        caja: {
            hideSuggestions:false,
            data: [],
            attributes: {
                id_caja:null,
                nombre:'',
                id_empleado:'',
            },
            tempAttributes: {
                id_caja:null,
                nombre:'',
                id_empleado:'',
            },
            model: {
                id_caja:null,
                nombre:'',
                id_empleado:'',
            }
        },
        configEmpleado:{
            url:urlGlobal.simpleSuggestionsEmpleados,
            placeholder:'Nombre del Empleado',
            variableForSuggestions:'nombre',
            variableForSuggestionsId:'id_empleado'
        },
    },
    mounted() {
        this.$nextTick(function () {
            this.getCajas();
        })
    },
    methods: {
        //<editor-fold desc="Methods Moneda">

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

        submitFormCaja(){
            if (!this.caja.attributes.id_caja) {
                this.registerCaja();
            } else {
                this.updateCaja();
            }
        },
        getCajas(){
            axios.get(urlGlobal.getCajas
            ).then(response => {
                this.caja.data=response.data;
            }).catch(errors => {
                console.log('errors');
                this.notificationErrors(errors);
            });
        },
        registerCaja(){
            let inputs = Object.assign({},this.caja.attributes);
            axios.post(urlGlobal.resourcesCaja, inputs
            ).then(response => {
                this.getCajas();
                Object.assign(this.caja.attributes, this.caja.model);
                this.caja.hideSuggestions = true;
                setTimeout(() => {
                    this.caja.hideSuggestions = false;
                }, 1);
                this.notificationSuccess();
            }).catch(errors => {
                this.notificationErrors(errors);
            });
        },
        selectEmpleado(response){
            if (response && response.id_empleado) {
                this.caja.attributes.id_empleado = response.id_empleado;
                this.caja.attributes.empleado = response;
            } else {
                this.caja.attributes.id_empleado = null;
                this.caja.attributes.empleado = {
                    id_empleado:null,
                    nombre:''
                };
            }
        },
        updateCaja(){
            let inputs = Object.assign({},this.caja.attributes);
            axios.put(urlGlobal.resourcesCaja + '/' + inputs.id_caja, inputs)
                .then(response => {
                    $('#modal-edit-caja').modal('hide');
                    Object.assign(this.caja.tempAttributes ,this.caja.attributes);
                    this.notificationSuccess();
                }).catch(errors => {
                this.notificationErrors(errors);
            });
        },
        modeEditCaja(caja){
            this.caja.attributes.id_empleado = caja.empleado.id_empleado;
            this.caja.tempAttributes = caja;
            this.caja.attributes = Object.assign({}, caja);
        },
        cancelModeEditCaja() {
            this.caja.attributes=Object.assign({}, this.caja.model);
            this.caja.tempAttributes=Object.assign({}, this.caja.model);
        },

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
                response.data.forEach(value=> this.compra.compra_credito_total+=value.monto);
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