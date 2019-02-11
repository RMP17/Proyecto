var appVenta = new Vue({
    el: '#app-venta',
    data: {
        monedas: [],
        almacenes: [],
        venta: {
            paginated: {
                size: 15,
                pageNumber: 0,
            },
            filters:{
              empleado:'',
              almacen:'',
              cliente:''
            },
            oneVenta:null,
            credito:{
                attributes:{
                    id:null,
                    monto:null,
                    observaciones:'',
                    tipo_pago:'ef',
                    id_venta:null
                },
                model:{
                    id:null,
                    monto:null,
                    observaciones:'',
                    tipo_pago:'ef',
                    id_venta:null
                },
                data:[],
                total:0,
                hideTotal:false
            },
            cliente:{
                attributes:{
                    id_cliente:null,
                    razon_social:'',
                    nit:'',
                    actividad:'',
                    telefono:'',
                    celular:'',
                    correo:'',
                    direccion:'',
                    id_ciudad:null
                },
                tempAttributes:{
                    id_cliente:null,
                    razon_social:'',
                    nit:'',
                    actividad:'',
                    telefono:'',
                    celular:'',
                    correo:'',
                    direccion:'',
                    id_ciudad:null
                },
                model:{
                    id_cliente:null,
                    razon_social:'',
                    nit:'',
                    actividad:'',
                    telefono:'',
                    celular:'',
                    correo:'',
                    dirrecion:'',
                    id_ciudad:null
                },
                data:[],
                total:0,
            },
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
                precios: {},
                stock:null
            },
            tempArticulo:{
                categoria:{
                    categoria:''
                },
                fabricante:{
                    nombre:''
                },
                precios: {},
                stock:null
            },
            detallesVenta:[],
            detalleVenta:{
                cantidad:null,
                precio_unitario:null,
                id_articulo:null,
                id_almacen:null,
                id_sucursal:null,
                subtotal:null,
                nombre: '',
            },
            tempDetalleVenta:{
                cantidad:null,
                precio_unitario:null,
                id_articulo:null,
                id_almacen:null,
                id_sucursal:null,
                subtotal:null,
                nombre: '',
            },
            totalDetallesVenta:0,
            almacenSelected:null,
            attributes: {
                id_venta: null,
                descuento: null,
                costo_total: 0,
                importe: 0,
                codigo_tarjeta_cheque: '',
                estatus: '',
                id_moneda: null,
                id_cliente: null,
                id_caja: null,
                tipo_pago: 'ef',
                detalles_venta:[]
            },
            tempAttributes: {
                id_venta: null,
                descuento: null,
                costo_total: null,
                importe: 0,
                codigo_tarjeta_cheque: '',
                estatus: '',
                id_moneda: null,
                id_cliente: null,
                id_caja: null,
                tipo_pago: '',
                detalles_venta:[]
            },
            model: {
                id_venta: null,
                descuento: null,
                costo_total: '',
                codigo_tarjeta_cheque: '',
                estatus: '',
                id_moneda: null,
                id_cliente: null,
                id_caja: null,
                tipo_pago: '',
                detalles_venta:[]
            },
        },
        configCliente:{
            url:urlGlobal.getSuggestionsClientes,
            placeholder:'Nombre del cliente',
            variableForSuggestions:'razon_social',
            variableForSuggestionsId:'id_cliente'
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
        configCiudad:{
            url:urlGlobal.suggestionsOfCiudades,
            placeholder:'Buscar por nombre de Ciudad',
            variableForSuggestions:'pais_ciudad',
            variableForSuggestionsId:'id_ciudad'
        },
    },
    created() {
        this.$nextTick(function () {
            this.getMonedas();
            this.getAlmacenes();
        })
        /*this.getProveedores();
        this.getMonedas();
        this.getCargos();
        this.compra.attributes.fecha=this.dateNow();*/
    },
    methods: {
        registerCliente: function() {
            let inputs = this.venta.cliente.attributes;
            axios.post(urlGlobal.resourcesCliente, inputs
            ).then(response => {
                this.venta.cliente.attributes = Object.assign({},this.venta.cliente.model);
                this.venta.cliente.tempAttributes = response.data;
                $('#modal-new-client').modal('hide');
                this.notificationSuccess();
            }).catch(errors => {
                console.log('errors');
                this.notificationErrors(errors);
            });

        },
        selectCiudad(response){
            if (response && response.id_ciudad) {
                this.venta.cliente.attributes.id_ciudad = response.id_ciudad;
            }
        },
        selectCliente(response){
            if (response && response.id_cliente) {
                this.venta.attributes.id_cliente = response.id_cliente;
                this.venta.cliente.tempAttributes = response;
                this.$refs.txtNit.value=response.nit;
            } else {
                this.venta.attributes.id_cliente = null;
                /*this.venta.cliente.tempAttributes = Object.assign({},this.venta.cliente.model);*/
                this.$refs.txtNit.value='';
            }
        },

        getMonedas: function() {
            axios.get(urlGlobal.resourcesMoneda)
                .then(response => {
                    this.monedas = response.data;
                    this.monedas.forEach(moneda=>{
                        if(moneda.nombre==='Bolivianos' || moneda.nombre==='bolivianos'){
                            this.venta.attributes.id_moneda = moneda.id_moneda;
                        }
                    });
                }).catch(errors => {
                console.log('errors');
            });
        },
        getClienteByNit: function(event){
            if (event.target.value === "") return;
            axios.get(urlGlobal.getClienteByNit+event.target.value)
                .then(response => {
                    if(response.data.id_cliente) {
                        this.venta.cliente.tempAttributes = Object.assign({},response.data);
                        this.venta.attributes.id_cliente = response.data.id_cliente;
                    } else {
                        this.venta.cliente.tempAttributes = Object.assign({},this.venta.cliente.model);
                        this.venta.attributes.id_cliente = null;
                    }
                }).catch(errors => {
                console.log('errors');
            });
        },

        //<editor-fold desc="Methods of Venta">
        assignAnIdentificationOfArticuloToDetalleVenta(response) {
            if (response && response.id_articulo) {
                this.venta.detalleVenta.id_articulo = response.id_articulo;
                this.venta.detalleVenta.nombre = response.nombre;
                this.venta.articulo = response;
                this.$refs.input_articulo_codigo.value = response.codigo;
                this.$refs.input_articulo_codigo_barra.value = response.codigo_barra;
                this.$refs.txtCantidad.select();
            } else {
                this.venta.detalleVenta = Object.assign({},this.venta.tempDetalleVenta);
                this.venta.articulo = Object.assign({},this.venta.tempArticulo);
                this.$refs.input_articulo_codigo.value = '';
                this.$refs.input_articulo_codigo_barra.value = '';
            }
        },
        selectIdSucursal() {
            if (Object.keys(this.venta.articulo.precios).length>0) {
                this.venta.detalleVenta.id_sucursal = this.venta.articulo.precios.id_sucursal;
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
                    this.venta.detalleVenta.precio_unitario=null;
                    if( Object.keys(response.data).length === 0){
                        this.venta.detalleVenta = Object.assign({},this.venta.tempDetalleVenta);
                        this.venta.articulo = Object.assign({},this.venta.tempArticulo);
                        this.venta.tempDetalleVenta.nombre = '';
                        this.$refs.input_articulo_codigo.value = '';
                    } else {
                        this.venta.detalleVenta.id_articulo = response.data[0].id_articulo;
                        this.venta.detalleVenta.nombre = response.data[0].nombre;
                        this.venta.articulo = response.data;
                        this.venta.tempDetalleVenta.nombre = response.data[0].nombre;
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
                    this.venta.detalleVenta.precio_unitario=null;
                    if( Object.keys(response.data).length === 0){
                        this.venta.detalleVenta = Object.assign({},this.venta.tempDetalleVenta);
                        this.venta.articulo = Object.assign({},this.venta.tempArticulo);
                        this.venta.tempDetalleVenta.nombre = '';
                        this.$refs.input_articulo_codigo.value = '';
                    } else {
                        this.venta.detalleVenta.id_articulo = response.data[0].id_articulo;
                        this.venta.detalleVenta.nombre = response.data[0].nombre;
                        this.venta.tempDetalleVenta.nombre = response.data[0].nombre;
                        this.venta.articulo = response.data[0];
                        this.$refs.input_articulo_codigo_barra.value = response.data[0].codigo_barra;
                        this.$refs.txtCantidad.select();
                    }
                }).catch(errors => {
                    console.log(errors);
                });
            }
        },
        getVentasByRageDate(event){
            axios.post(urlGlobal.getVentasByRageDate, event
            ).then(response => {
                this.venta.data = response.data;
                this.venta.data_with_filters = this.venta.data;
                this.venta.paginated.pageNumber = 0;
            }).catch(errors => {
                console.log(errors);
            });
        },
        getVentaById(venta){
            axios.get(urlGlobal.getVentaById+venta.id_venta,
            ).then(response => {
                this.venta.oneVenta=response.data;
                this.$nextTick(function () {
                    this.printVenta();
                })
            }).catch(errors => {
                console.log(errors);
            });
        },
        assignAnIdentificationOfVentaToCredito(venta){
            Object.assign(this.venta.credito.attributes, this.venta.credito.model);
            this.venta.credito.attributes.id_venta = venta.id_venta;
            this.venta.tempAttributes = venta;
            this.getVentaCredito(venta.id_venta);
        },
        getVentaCredito(id_venta){
            this.venta.credito.hideTotal=true;
            axios.get(urlGlobal.getVentaCredito+id_venta
            ).then(response => {
                this.venta.credito.total=0;
                this.venta.credito.data=response.data;
                response.data.forEach(value=> this.venta.credito.total+= parseFloat(value.monto));
                this.venta.credito.hideTotal=false;
            }).catch(errors => {
                console.log(errors);
            });
        },
        cancelSale(venta){
            let isConfirmed=confirm("¡Está seguro de cancelar la venta!");
            if(isConfirmed){
                axios.patch(urlGlobal.cancelSale+venta.id_venta
                ).then(response => {
                    venta.estatus='vc';
                    this.notificationSuccess();
                }).catch(errors => {
                    console.log(errors);
                });
            }
        },
        registerVentaCredito: function() {
            let inputs = this.venta.credito.attributes;
            axios.post(urlGlobal.postVentaCredito, inputs
            ).then(response => {
                let id_venta = this.venta.credito.attributes.id_venta;
                let tipo_pago = this.venta.credito.attributes.tipo_pago;
                Object.assign(this.venta.credito.attributes, this.venta.credito.attributes.model);
                this.venta.credito.attributes.id_venta = id_venta;
                this.venta.credito.attributes.tipo_pago = tipo_pago;
                this.getVentaCredito(id_venta);
                this.notificationSuccess();
            }).catch(errors => {
                console.log('errors');
                this.notificationErrors2(errors);
            });

        },

        addDetalleVenta(){
            if( this.venta.detalleVenta.cantidad
                && this.venta.detalleVenta.precio_unitario
                && this.venta.detalleVenta.id_articulo
            ){
                let index = this.venta.attributes.detalles_venta.findIndex(detalle => {
                    return detalle.id_articulo === this.venta.detalleVenta.id_articulo;
                });
                if (index === -1) {
                    this.venta.attributes.detalles_venta.push(this.venta.detalleVenta);
                } else {
                    let detalles_venta = this.venta.attributes.detalles_venta[index];
                    detalles_venta.cantidad += this.venta.detalleVenta.cantidad;
                }

                this.calcularTotale();
                this.venta.articulo.categoria.categoria ='';
                this.venta.articulo.fabricante.nombre ='';
                this.venta.articulo.stock = null;
                this.venta.detalleVenta = Object.assign({},this.venta.tempDetalleVenta);
                this.venta.hideSuggestionsArticulo = true;
                setTimeout(()=>{this.venta.hideSuggestionsArticulo = false;},1);
            } else {
                let errors=[
                  '<li>El Árticulo es requerido</li>',
                  '<li>El precio unitario es requerido</li>',
                  '<li>La cantidad es requerida</li>',
                ];
                toastr.error(errors, 'Revice los campos', {timeOut: 10000});
            }
        },
        removeDetalleVenta(index){
            this.venta.attributes.detalles_venta.splice(index, 1);
            this.calcularTotale();
        },
        calcularTotale(){
            let total = 0;
            this.venta.attributes.detalles_venta.forEach(detalle => {
                let subtotal = 0;
                subtotal = detalle.cantidad * detalle.precio_unitario;
                detalle.subtotal = subtotal;
                total += subtotal;
            });
            this.venta.totalDetallesVenta = total - this.venta.attributes.descuento;
        },
        submitFormVenta(){
            let inputs = Object.assign({}, this.venta.attributes);
            axios.post(urlGlobal.resourcesVenta, inputs
            ).then(response => {
                this.venta.attributes.detalles_venta = [];
                this.venta.totalDetallesVenta = 0;
                this.venta.attributes.importe = 0;
                this.venta.oneVenta = response.data;
                this.$nextTick(function () {
                    this.printVenta();
                });
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
            },400);
        },
        getSalesOnCreditInForce(){
            axios.get(urlGlobal.getSalesOnCreditInForce
            ).then(response => {
                this.venta.data = response.data;
                this.venta.data_with_filters = this.venta.data;
                this.venta.paginated.pageNumber = 0;
            }).catch(errors => {
                console.log(errors);
            });
        },
        //</editor-fold>

        //<editor-fold desc="Methods paginated">
        nextPage(){
            this.venta.paginated.pageNumber++;
        },
        prevPage(){
            this.venta.paginated.pageNumber--;
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
                this.venta.filters.empleado = empleado.nombre;
                this.goThroughFilters();
            }
        },
        filterByAlmacen: function(almacen){
            if(almacen.target.options.selectedIndex > -1) {
                let index = almacen.target.options.selectedIndex;
                this.venta.filters.almacen = almacen.target.options[index].text;
                this.goThroughFilters();
            }
        },
        filterByCliente: function(cliente){
            if(cliente && cliente.razon_social) {
                this.venta.filters.cliente = cliente.razon_social;
                this.goThroughFilters();
            }
        },

        removeFilters(){
            this.venta.filters.cliente='';
            this.venta.filters.almacen='';
            this.venta.filters.empleado='';
            this.venta.hideFilters = true;
            this.venta.paginated.pageNumber = 0;
            setTimeout(()=>this.venta.hideFilters = false,1);
            this.goThroughFilters();
        },
        viewDetallesVenta(detalles){
            this.venta.detallesVenta = detalles.detalles_venta;
        },
        goThroughFilters(){
            let filtered_data = this.venta.data;
            if(this.venta.filters.empleado.length>0){
                filtered_data = filtered_data.filter( _empleado =>{
                    return _empleado.empleado === this.venta.filters.empleado;
                });
            }
            if(this.venta.filters.almacen.length>0){
                filtered_data = filtered_data.filter( _almacen =>{
                    return _almacen.almacen === this.venta.filters.almacen;
                });
            }
            if(this.venta.filters.cliente.length>0){
                filtered_data = filtered_data.filter( _cliente =>{
                    return _cliente.cliente === this.venta.filters.cliente;
                });
            }
            this.venta.paginated.pageNumber = 0;
            this.venta.data_with_filters=filtered_data;
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
        },
        printVenta(){
            /*$.print("#myPrintArea");*/
            window.print();
        }
    },
    computed: {
        pageCount: function(){
            let l = this.venta.data_with_filters.length,
                s = this.venta.paginated.size;
            return Math.ceil(l/s);
        },
        paginatedData: function(){
            const start = this.venta.paginated.pageNumber * this.venta.paginated.size,
                end = start + this.venta.paginated.size;
            return this.venta.data_with_filters
                .slice(start, end);
        }
    }
});