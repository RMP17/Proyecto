var appProduccion = new Vue({
    el: '#app-produccion',
    data: {
        produccion: {
            /*hideFilters:false,*/
            hideSuggestionsClient: false,
            hideFilters: false,
            hideSuggestionsCiudad: false,
            hideSuggestionsArticulo: false,
            filters:{
                empleado:'',
                almacen:'',
                cliente:'',
            },
            data_with_filters:[],
            paginated: {
                size: 15,
                pageNumber: 0,
            },
            totalDetalles: 0,
            oneProduccion: null,
            articulo: {
                attributes: {
                    categoria: {
                        categoria: ''
                    },
                    fabricante: {
                        nombre: ''
                    },
                    precios: [],
                    stock: null
                },
                model: {
                    categoria: {
                        categoria: ''
                    },
                    fabricante: {
                        nombre: ''
                    },
                    precios: [],
                    stock: null
                }
            },
            cliente: {
                one: {
                    id_cliente: null,
                    razon_social: null,
                    nit: null,
                    actividad: null,
                    telefono: null,
                    celular: null,
                    correo: null,
                    direccion: null,
                    id_ciudad: null,
                },
                attributes: {
                    id_cliente: null,
                    razon_social: null,
                    nit: null,
                    actividad: null,
                    telefono: null,
                    celular: null,
                    correo: null,
                    direccion: null,
                    id_ciudad: null,
                },
                model: {
                    id_cliente: null,
                    razon_social: null,
                    nit: null,
                    actividad: null,
                    telefono: null,
                    celular: null,
                    correo: null,
                    direccion: null,
                    id_ciudad: null,
                }
            },
            detalle: {
                attributes: {
                    id_detalle_produccion: null,
                    cantidad: null,
                    precio_unitario: null,
                    ancho: null,
                    largo: null,
                    id_articulo: null,
                    id_almacen: null,
                    id_produccion: null,
                },
                model: {
                    id_detalle_produccion: null,
                    cantidad: null,
                    precio_unitario: null,
                    ancho: null,
                    largo: null,
                    id_articulo: null,
                    id_almacen: null,
                    id_produccion: null,
                }
            },
            credito:{
                hideTotal:false,
                data:[],
                total:null,
                attributes:{
                    id:null,
                    monto:null,
                    observaciones:null,
                    id_produccion:null,
                },
                mode:{
                    id:null,
                    monto:null,
                    observaciones:null,
                    id_produccion:null,
                }
            },
            attributes: {
                id_produccion: null,
                observaciones: null,
                importe: null,
                fecha_inicio: null,
                fecha_entrega: null,
                tipo_pago: 'ef',
                id_cliente: null,
                detalles: []
            },
            model: {
                id_produccion: null,
                observaciones: null,
                importe: null,
                fecha_inicio: null,
                fecha_entrega: null,
                tipo_pago: 'ef',
                id_cliente: null,
                detalles: []
            },
            data: [],
        },
        almacenes:[],
        configCiudad: {
            url: urlGlobal.suggestionsOfCiudades,
            placeholder: 'Buscar por nombre de Ciudad',
            variableForSuggestions: 'pais_ciudad',
            variableForSuggestionsId: 'id_ciudad'
        },
        configArticulo: {
            url: urlGlobal.getArticuloForName,
            placeholder: 'Nombre del Artículo',
            variableForSuggestions: 'nombre',
            variableForSuggestionsId: 'id_articulo'
        },
        configCliente: {
            url: urlGlobal.getSuggestionsClientes,
            placeholder: 'Nombre del cliente',
            variableForSuggestions: 'razon_social',
            variableForSuggestionsId: 'id_cliente'
        },
        configEmpleado: {
            url: urlGlobal.simpleSuggestionsEmpleados,
            placeholder: 'Nombre del Empleado',
            variableForSuggestions: 'nombre',
            variableForSuggestionsId: 'id_empleado'
        },
    },
    mounted() {
        this.$nextTick(function () {
            this.almacenes=almacenes_php;
        })
    },
    methods: {
        registerCliente: function () {
            let inputs = this.produccion.cliente.attributes;
            axios.post(urlGlobal.resourcesCliente, inputs
            ).then(response => {
                this.produccion.cliente.attributes = Object.assign({}, this.produccion.cliente.model);
                this.produccion.attributes.id_cliente = response.data.id_cliente;
                Object.assign(this.produccion.cliente.one, response.data);
                this.$refs.txtNit.value = ref = this.produccion.cliente.one.nit;
                $('#modal-new-client-produccion').modal('hide');
                this.notificationSuccess();
            }).catch(errors => {
                console.log('errors');
                this.notificationErrors(errors);
            });

        },
        selectCiudad(response) {
            if (response && response.id_ciudad) {
                this.produccion.cliente.attributes.id_ciudad = response.id_ciudad;
            }
        },
        selectArticuloOfSuggestions(response) {
            if (response && response.id_articulo) {
                this.produccion.detalle.attributes.id_articulo = response.id_articulo;
                this.produccion.articulo.attributes = response;
                this.$refs.input_articulo_codigo_pro.value = response.codigo;
                this.$refs.input_articulo_codigo_barra_pro.value = response.codigo_barra;
                this.$refs.txtCantidadProduccion.select();
            } else {
                this.produccion.detalle.attributes = Object.assign({}, this.produccion.detalle.model);
                this.produccion.articulo.attributes = Object.assign({}, this.produccion.articulo.model);
                this.$refs.input_articulo_codigo_pro.value = '';
                this.$refs.input_articulo_codigo_barra_pro.value = '';
            }
        },
        selectIdSucursal() {
            if (Object.keys(this.produccion.articulo.attributes.precios).length > 0) {
                this.produccion.detalle.attributes.id_sucursal = this.produccion.articulo.attributes.precios.id_sucursal;
            }
        },
        addToListAndRemove() {
            if (this.produccion.detalle.attributes.id_articulo
                && this.produccion.detalle.attributes.cantidad
                && this.produccion.detalle.attributes.precio_unitario
            ) {
                this.produccion.detalle.attributes.nombre = this.produccion.articulo.attributes.nombre;
                this.produccion.attributes.detalles.push(this.produccion.detalle.attributes);
                this.produccion.detalle.attributes = Object.assign({}, this.produccion.detalle.model);
                this.calcularTotale();
                this.produccion.articulo.attributes.categoria.categoria = '';
                this.produccion.articulo.attributes.fabricante.nombre = '';
                this.produccion.articulo.attributes.stock = null;
                this.produccion.detalle.attributes = Object.assign({}, this.produccion.detalle.model);
                this.produccion.hideSuggestionsArticulo = true;
                setTimeout(() => {
                    this.produccion.hideSuggestionsArticulo = false;
                }, 0);
            } else {
                let errors = [
                    '<li>El artículo es requerido</li>',
                    '<li>La cantidad es requerida</li>',
                    '<li>El precio unitario es requerida</li>',
                ];
                toastr.error(errors, 'Revice los campos', {timeOut: 10000});
            }
        },
        addToList() {
            if (this.produccion.detalle.attributes.id_articulo
                && this.produccion.detalle.attributes.cantidad
                && this.produccion.detalle.attributes.precio_unitario
            ) {
                this.produccion.detalle.attributes.nombre = this.produccion.articulo.attributes.nombre;
                this.produccion.attributes.detalles.push(this.produccion.detalle.attributes);
                this.calcularTotale();
                let detalle = Object.assign({}, this.produccion.detalle.attributes);
                this.produccion.detalle.attributes = detalle;
                this.produccion.detalle.attributes.largo = null;
                this.produccion.detalle.attributes.ancho = null;
            } else {
                let errors = [
                    '<li>El artículo es requerido</li>',
                    '<li>La cantidad es requerida</li>',
                    '<li>El precio unitario es requerida</li>',
                ];
                toastr.error(errors, 'Revice los campos', {timeOut: 10000});
            }
        },
        removeOfList(index) {
            this.produccion.attributes.detalles.splice(index, 1);
        },
        registerPayCreditoOfProduccion: function() {
            let inputs = this.produccion.credito.attributes;
            axios.post(urlGlobal.payCreditOfProduccion, inputs
            ).then(response => {
                let id_produccion = this.produccion.credito.attributes.id_produccion;
                /*let tipo_pago = this.produccion.credito.attributes.tipo_pago*/
                Object.assign(this.produccion.credito.attributes, this.produccion.credito.attributes.model);
                this.produccion.credito.attributes.id_produccion = id_produccion;
                /*this.produccion.credito.attributes.tipo_pago = tipo_pago;*/
                this.getCreditoOfProduccion(id_produccion);
                this.notificationSuccess();
            }).catch(errors => {
                console.log('errors');
                this.notificationErrors2(errors);
            });

        },
        calcularTotale() {
            let total = 0;
            this.produccion.attributes.detalles.forEach(detalle => {
                let subtotal = 0;
                subtotal = detalle.cantidad * detalle.precio_unitario;
                detalle.subtotal = subtotal;
                total += subtotal;
            });
            this.produccion.totalDetalles = total;
        },
        selectCliente(response) {
            if (response && response.id_cliente) {
                this.produccion.attributes.id_cliente = response.id_cliente;
                this.produccion.cliente.one = response;
                this.$refs.txtNit.value = response.nit;
            } else {
                this.produccion.attributes.id_cliente = null;
                this.$refs.txtNit.value = '';
            }
        },
        getClienteByNit: function (event) {
            if (event.target.value === "") return;
            axios.get(urlGlobal.getClienteByNit + event.target.value)
                .then(response => {
                    if (response.data.id_cliente) {
                        this.produccion.cliente.one = Object.assign({}, response.data);
                        this.produccion.attributes.id_cliente = response.data.id_cliente;
                    } else {
                        Object.assign(this.produccion.cliente.one, this.produccion.cliente.model);
                        this.produccion.cliente.one.razon_social = '';
                        this.produccion.attributes.id_cliente = null;
                    }
                }).catch(errors => {
                console.log('errors');
            });
        },
        focusButtonYes() {
            this.$nextTick(function () {
                setTimeout(() => {
                    document.activeElement.blur();
                    this.$refs.btnSi.focus();
                }, 400);
            });
        },
        submitFormProduccion(){
            let inputs = Object.assign({}, this.produccion.attributes);
            axios.post(urlGlobal.resourcesProduccion, inputs
            ).then(response => {
                this.produccion.attributes.detalles = [];
                this.produccion.totalDetalles = 0;
                this.produccion.attributes.importe = 0;
                this.produccion.oneProduccion = response.data;
                /*this.$nextTick(function () {
                    this.printVenta();
                });*/
                this.notificationSuccess();
            }).catch(errors => {
                console.log('errors');
                this.notificationErrors(errors);
            });
        },

        forceGetProductionCredits(){
            axios.get(urlGlobal.forceGetProductionCredits
            ).then(response => {
                this.produccion.data = response.data;
                this.produccion.data_with_filters = this.produccion.data;
                this.produccion.paginated.pageNumber = 0;
            }).catch(errors => {
                console.log(errors);
            });
        },
        selectCreditProduccion(produccion){
            Object.assign(this.produccion.credito.attributes, this.produccion.credito.model);
            this.produccion.credito.attributes.id_produccion = produccion.id_produccion;
            this.produccion.oneProduccion = produccion;
            this.getCreditoOfProduccion(produccion.id_produccion);
        },
        getProduccionesByRageDate(event){
            axios.post(urlGlobal.getProduccionesByRageDate, event
            ).then(response => {
                // todo: asignar variables con sus respectivos valores y revisar si esta declarado
                this.produccion.data = response.data;
                this.produccion.data_with_filters = this.produccion.data;
                this.produccion.paginated.pageNumber = 0;
            }).catch(errors => {
                console.log(errors);
            });
        },

        getCreditoOfProduccion(id_produccion){
            this.produccion.credito.hideTotal=true;
            axios.get(urlGlobal.getCreditoOfProduccion+id_produccion
            ).then(response => {
                this.produccion.credito.total=0;
                this.produccion.credito.data=response.data;
                response.data.forEach(value=> this.produccion.credito.total+= parseFloat(value.monto));
                this.produccion.credito.hideTotal=false;
            }).catch(errors => {
                console.log(errors);
            });
        },
        //<editor-fold desc="Methods of Filters">
        filterByEmpleado(empleado) {
            if (empleado && empleado.nombre) {
                this.produccion.filters.empleado = empleado.nombre;
                this.goThroughFilters();
            }
        },
        filterByCliente(cliente) {
            if (cliente && cliente.razon_social) {
                this.produccion.filters.cliente = cliente.razon_social;
                this.goThroughFilters();
            }
        },

        getProduccionById(id_produccion){
            axios.get(urlGlobal.resourcesProduccion+'/'+id_produccion,
            ).then(response => {
                if (Object.keys(response.data).length>0){
                    this.produccion.oneProduccion=response.data;
                    this.produccion.data=Array(response.data);
                    this.produccion.data_with_filters=this.produccion.data;
                } else {
                    this.produccion.oneProduccion=null;
                    this.produccion.data=[];
                    this.produccion.data_with_filters=this.produccion.data;
                }
                /*this.$nextTick(function () {
                    this.printVenta();
                })*/
            }).catch(errors => {
                console.log(errors);
            });
        },
        printProduccion(produccion){
            this.produccion.oneProduccion=produccion;
            this.$nextTick(function () {
                    this.print(this.$refs.print_produccion);
            });
        },
        printEtiqueta(produccion){
            this.produccion.oneProduccion=produccion;
            this.$nextTick(function () {
                    this.print(this.$refs.print_produccion_etiqueta);
            });
        },
        filterByAlmacen: function(almacen){
            if(almacen.target.options.selectedIndex > -1) {
                let index = almacen.target.options.selectedIndex;
                this.produccion.filters.almacen = almacen.target.options[index].text;
                this.goThroughFilters();
            }
        },
        removeFilters() {
            this.produccion.filters.empleado = '';
            this.produccion.filters.cliente = '';
            this.produccion.filters.almacen = '';
            this.produccion.hideFilters = true;
            this.produccion.paginated.pageNumber = 0;
            this.produccion.oneProduccion=null;
            setTimeout(() => this.produccion.hideFilters = false, 0);
            this.goThroughFilters();
        },
        viewDetallesProduccion(produccion) {
            this.produccion.oneProduccion = produccion;
        },

        goThroughFilters() {
            let filtered_data = this.produccion.data;
            if (this.produccion.filters.empleado.length > 0) {
                filtered_data = filtered_data.filter(_empleado => {
                    return _empleado.empleado === this.medicion.filters.empleado;
                });
            }
            if (this.produccion.filters.cliente.length > 0) {
                filtered_data = filtered_data.filter(_cliente => {
                    return _cliente.cliente.razon_social === this.produccion.filters.cliente;
                });
            }
            if (this.produccion.filters.almacen.length > 0) {
                filtered_data = filtered_data.filter(_almacen => {
                    return _almacen.almacen === this.produccion.filters.almacen;
                });
            }
            this.produccion.paginated.pageNumber = 0;
            this.produccion.data_with_filters = filtered_data;
        },
        //</editor-fold>
        //<editor-fold desc="Methods paginated">
        nextPage() {
            this.produccion.paginated.pageNumber++;
        },

        prevPage() {
            this.produccion.paginated.pageNumber--;
        },
        //</editor-fold>

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
        toDateTimeLocal2(datetime) {
            let _datetime = datetime;
            ten = function (i) {
                return (i < 10 ? '0' : '') + i;
            };
            let YYYY = _datetime.getFullYear();
            let MM = ten(_datetime.getMonth() + 1);
            let DD = ten(_datetime.getDate());
            let HH = ten(_datetime.getHours());
            let II = ten(_datetime.getMinutes());
            return YYYY + '-' + MM + '-' + DD + 'T' +
                HH + ':' + II;
        },
        exportPdf() {
            const doc = new jsPDF('p', 'mm', 'letter', true);
            doc.autoTable({
                html: '#exportproduccion'
            });
            doc.save('produccion.pdf');
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
        //<editor-fold desc="Methods of Notifications">
        formatErrors: function (errors) {
            let _errors = errors.response.data.errors;
            let response = [];
            Object.keys(errors.response.data.errors).forEach(value => {
                response.push('<li>' + _errors[value][0] + '</li>');
            });
            return response
        },
        formatErrors2: function (errors) {
            let _errors = errors.response.data;
            let response = [];
            Object.keys(errors.response.data).forEach(value => {
                response.push('<li>' + _errors[value][0] + '</li>');
            });
            return response
        },
        notificationSuccess() {
            toastr.success('Tarea realizada con Exito', {timeOut: 10000});
        },
        notificationErrors(errors) {
            let _errors;
            _errors = this.formatErrors(errors);
            toastr.error(_errors, 'Corrija los Siguientes Errores', {timeOut: 10000});
        },
        notificationErrors2(errors) {
            let _errors;
            _errors = this.formatErrors2(errors);
            toastr.error(_errors, 'Corrija los Siguientes Errores', {timeOut: 10000});
        },
        //</editor-fold
        numberPositiveDirective(event) {
            // Allow decimal numbers and negative values
            let regex = new RegExp(/^([0-9]*)$/gm);
            // Allow key codes for special events. Reflect :
            // Backspace, tab, end, home
            specialKeys = ['Enter', 'Backspace', 'Tab', 'End', 'Home', 'Delete',
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
        numberFloatDirective(event) {
            let regex = new RegExp(/^[+]?([0-9]{0,})*[.]?([0-9]{1,2})?$/g);
            let specialKeys = ['Enter', 'Backspace', 'Tab', 'End', 'Home', 'Delete', 'ArrowLeft', 'ArrowUp', 'ArrowRight', 'ArrowDown'];

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
    },
    computed: {
        pageCount: function () {
            let l = this.produccion.data_with_filters.length,
                s = this.produccion.paginated.size;
            return Math.ceil(l / s);
        },
        paginatedData: function () {
            const start = this.produccion.paginated.pageNumber * this.produccion.paginated.size,
                end = start + this.produccion.paginated.size;
            return this.produccion.data_with_filters
                .slice(start, end);
        },
    }
});