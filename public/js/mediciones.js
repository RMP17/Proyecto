var appMovimientoAlmacen = new Vue({
    el: '#app-medicion',
    data: {
        medicion: {
            hideFilters:false,
            hideFiltersSuggestions:false,
            data: [],
            cliente: {
                attributes:{
                    id_cliente:null,
                    nit:null,
                    razon_social:null,
                },
                model:{
                    id_cliente:null,
                    nit:null,
                    razon_social:null,
                }
            },
            paginated: {
                size: 15,
                pageNumber: 0,
            },
            data_with_filters:[],
            filters:{
                empleado:'',
                almacen_origen:'',
                almacen_destino:'',
            },
            oneMedicion:null,
            tempClienteRazonSocial:null,
            tempEmpleadoNombre:'',
            detalle:{
                attributes:{
                    id:null,
                    descripcion:null,
                    ancho:null,
                    alto:null,
                    cantidad:null,
                    ubicacion:null,
                },
                model:{
                    id:null,
                    descripcion:null,
                    ancho:null,
                    alto:null,
                    cantidad:null,
                    ubicacion:null,
                }
            },
            attributes: {
                id:null,
                fecha_visita:null,
                direccion:null,
                descripcion_direccion:null,
                observaciones:null,
                id_cliente:null,
                id_empleado:null,
                detalles:[]
            },
            model: {
                id:null,
                fecha_visita:null,
                direccion:null,
                descripcion_direccion:null,
                observaciones:null,
                id_cliente:null,
                id_empleado:null,
                detalles:[]
            },
        },
        /*almacenes: [],
        configArticulo:{
            url:urlGlobal.getArticuloStockByName,
            placeholder:'Nombre del Artículo',
            variableForSuggestions:'nombre',
            variableForSuggestionsId:'id_articulo'
        },*/
        configCliente:{
            url:urlGlobal.getSuggestionsClientes,
            placeholder:'Nombre del cliente',
            variableForSuggestions:'razon_social',
            variableForSuggestionsId:'id_cliente'
        },
    },
    mounted() {
        this.$nextTick(function () {
            /*this.getAlmacenes();*/
        })
    },
    methods: {
        addToList(){
            if( this.medicion.detalle.attributes.descripcion
                && this.medicion.detalle.attributes.cantidad
                && this.medicion.detalle.attributes.ancho
                && this.medicion.detalle.attributes.alto
            ){
                this.medicion.attributes.detalles.push(this.medicion.detalle.attributes);
                this.medicion.detalle.attributes = Object.assign({},this.medicion.detalle.model);
            } else {
                let errors=[
                    '<li>La descripción es requerido</li>',
                    '<li>El alto es requerido</li>',
                    '<li>El ancho es requerido</li>',
                    '<li>La cantidad es requerida</li>',
                ];
                toastr.error(errors, 'Revice los campos', {timeOut: 10000});
            }
        },
        removeOfList(index){
            this.medicion.attributes.detalles.splice(index, 1);
        },
        selectCliente(response){
            if (response && response.id_cliente) {
                this.medicion.attributes.id_cliente = response.id_cliente;
                this.medicion.cliente.attributes = response;
                this.$refs.txtNit.value=response.nit;
            } else {
                this.medicion.attributes.id_cliente = null;
                this.$refs.txtNit.value='';
            }
        },
        getClienteByNit: function(event){
            if (event.target.value === "") return;
            this.medicion.cliente.attributes = Object.assign({}, this.medicion.cliente.model);
            axios.get(urlGlobal.getClienteByNit+event.target.value)
                .then(response => {
                    if(response.data.id_cliente) {
                        console.log(response);
                        Object.assign(this.medicion.cliente.attributes,response.data);
                        this.medicion.attributes.id_cliente = response.data.id_cliente;
                    } else {
                        this.medicion.cliente.attributes = Object.assign({}, this.medicion.cliente.model);
                        this.medicion.attributes.id_cliente = null;
                    }
                }).catch(errors => {
                console.log('errors');
            });
        },
        /*getAlmacenes: function(){
            axios.get(urlGlobal.resourcesAlmacen)
                .then(response => {
                    this.almacenes = response.data;
                }).catch(errors => {
                console.log('errors');
            });
        },
        getArticuloByCodigoBarras: function(codigoBarras) {
            if (!codigoBarras.target.value.length <= 0) {
                axios.get(urlGlobal.getArticuloStocksByCodigoBarra + codigoBarras.target.value
                ).then(response => {
                    response.log(response.data);
                    if( Object.keys(response.data).length !== 0){
                        this.movimiento_almacen.articulo.one.id_articulo = response.data.id_articulo;
                        this.movimiento_almacen.articulo.one.categoria = response.data.categoria.categoria;
                        this.movimiento_almacen.articulo.one.nombre = response.data.nombre;
                        this.movimiento_almacen.articulo.one.fabricante = response.data.fabricante.nombre;
                        this.movimiento_almacen.articulo.one.stocks = response.data.stock;
                        this.$refs.input_articulo_codigo.value = response.data.codigo;
                        this.movimiento_almacen.articulo.tempNombre=response.data.nombre;
                        if(this.movimiento_almacen.attributes.id_almacen_origen) {
                            let id_almacen= this.movimiento_almacen.attributes.id_almacen_origen;
                            this.selectStockAlmacen(id_almacen);
                        }
                    } else {
                        this.movimiento_almacen.articulo.one= Object.assign({},this.movimiento_almacen.articulo.model)
                        this.$refs.input_articulo_codigo.value = '';
                        this.movimiento_almacen.articulo.tempNombre='';
                    }
                }).catch(errors => {
                    console.log(errors);
                });
            }
        },
        getArticuloByCodigo: function(codigo) {
            if (!codigo.target.value.length <= 0) {
                axios.get(urlGlobal.getArticuloStocksByCodigo + codigo.target.value
                ).then(response => {
                    if( Object.keys(response.data).length !== 0){
                        this.movimiento_almacen.articulo.one.id_articulo = response.data.id_articulo;
                        this.movimiento_almacen.articulo.one.nombre = response.data.nombre;
                        this.movimiento_almacen.articulo.one.categoria = response.data.categoria.categoria;
                        this.movimiento_almacen.articulo.one.fabricante = response.data.fabricante.nombre;
                        this.movimiento_almacen.articulo.one.stocks = response.data.stock;
                        this.$refs.input_articulo_codigo_barra.value = response.data.codigo_barra;
                        this.movimiento_almacen.articulo.tempNombre=response.data.nombre;
                        if(this.movimiento_almacen.attributes.id_almacen_origen) {
                            let id_almacen= this.movimiento_almacen.attributes.id_almacen_origen;
                            this.selectStockAlmacen(id_almacen);
                        }
                    } else {
                        this.movimiento_almacen.articulo.one= Object.assign({},this.movimiento_almacen.articulo.model)
                        this.$refs.input_articulo_codigo_barra.value = '';
                        this.movimiento_almacen.articulo.tempNombre='';
                    }
                }).catch(errors => {
                    console.log(errors);
                });
            }
        },
        //<editor-fold desc="Methods of movimientos">
        selectStockAlmacen(id_almacen){
            console.log(id_almacen);
            let stocks= this.movimiento_almacen.articulo.one.stocks;
            for(stock in stocks) {
                if (stocks[stock].id_almacen===id_almacen){
                    this.movimiento_almacen.articulo.one.stock=stocks[stock].cantidad;
                    break;
                } else {
                    this.movimiento_almacen.articulo.one.stock=0;
                }
            }
        },
        selectArticuloMovimientoAlmacen(response) {
            if (response && response.id_articulo) {
                this.movimiento_almacen.articulo.one.id_articulo = response.id_articulo;
                this.movimiento_almacen.articulo.one.categoria = response.categoria.categoria;
                this.movimiento_almacen.articulo.one.nombre = response.nombre;
                this.movimiento_almacen.articulo.one.fabricante = response.fabricante.nombre;
                this.movimiento_almacen.articulo.one.stocks = response.stock;
                this.$refs.input_articulo_codigo.value = response.codigo;
                this.$refs.input_articulo_codigo_barra.value = response.codigo_barra;
                if(this.movimiento_almacen.attributes.id_almacen_origen) {
                    let id_almacen= this.movimiento_almacen.attributes.id_almacen_origen;
                    this.selectStockAlmacen(id_almacen);
                }
                /!*this.$refs.txtCantidad.select();*!/
            } else {
                this.movimiento_almacen.articulo.one= Object.assign({},this.movimiento_almacen.articulo.model)
                this.$refs.input_articulo_codigo.value = '';
                this.$refs.input_articulo_codigo_barra.value = '';
            }
        },
        submitFormMovimiento(){
            let inputs = Object.assign({},this.movimiento_almacen.attributes);
            axios.post(urlGlobal.resourcesMovimientoAlmacen, inputs
            ).then(response => {
                this.movimiento_almacen.attributes.detalles=[];
                this.notificationSuccess();
            }).catch(errors => {
                this.notificationErrors(errors);
            });
        },
        //</editor-fold>

        getMovimientoAlmacenByRageDate(event){
            axios.post(urlGlobal.getMovimientoAlmacenByRangeDate, event
            ).then(response => {
                this.movimiento_almacen.data = response.data;
                this.movimiento_almacen.data_with_filters = this.movimiento_almacen.data;
                this.movimiento_almacen.paginated.pageNumber = 0;
            }).catch(errors => {
                console.log(errors);
            });
        },
        cancelComprovante(_movimiento){
            let isConfirmed=confirm("¡Está seguro de cancelar la venta!");
            if(isConfirmed){
                axios.delete(urlGlobal.resourcesMovimientoAlmacen+'/'+_movimiento.id
                ).then(response => {
                    _movimiento.status='mc';
                    this.notificationSuccess();
                }).catch(errors => {
                    console.log(errors);
                });
            }
        },
        //<editor-fold desc="Methods of Filters">
        filterByEmpleado(empleado){
            if(empleado && empleado.nombre) {
                this.movimiento_almacen.filters.empleado = empleado.nombre;
                this.goThroughFilters();
            }
        },
        filterByAlmacenOrigen(almacen){
            if(almacen.target.options.selectedIndex > -1) {
                let index = almacen.target.options.selectedIndex;
                this.movimiento_almacen.filters.almacen_origen = almacen.target.options[index].text;
                this.goThroughFilters();
            }
        },
        filterByAlmacenDestino(almacen){
            if(almacen.target.options.selectedIndex > -1) {
                let index = almacen.target.options.selectedIndex;
                this.movimiento_almacen.filters.almacen_destino = almacen.target.options[index].text;
                this.goThroughFilters();
            }
        },
        removeFilters(){
            this.movimiento_almacen.filters.empleado='';
            this.movimiento_almacen.filters.almacen_destino='';
            this.movimiento_almacen.filters.almacen_origen='';
            this.movimiento_almacen.hideFilters = true;
            this.movimiento_almacen.paginated.pageNumber = 0;
            setTimeout(()=>this.movimiento_almacen.hideFilters = false,0);
            this.goThroughFilters();
        },
        viewDetallesMovimientoAlmacen(movimiento_almacen){
            this.movimiento_almacen.oneMovimientoAlmacen = movimiento_almacen;
        },
        printDetallesMovimientoAlmacen(movimiento_almacen){
            this.movimiento_almacen.oneMovimientoAlmacen = movimiento_almacen;
            this.$nextTick(function () {
                this.print();
            });
        },
        goThroughFilters(){
            let filtered_data = this.movimiento_almacen.data;
            if(this.movimiento_almacen.filters.empleado.length>0){
                filtered_data = filtered_data.filter( _empleado =>{
                    return _empleado.empleado === this.movimiento_almacen.filters.empleado;
                });
            }
            if(this.movimiento_almacen.filters.almacen_origen.length>0){
                filtered_data = filtered_data.filter( _almacen =>{
                    return _almacen.almacen_origen === this.movimiento_almacen.filters.almacen_origen;
                });
            }
            if(this.movimiento_almacen.filters.almacen_destino.length>0){
                filtered_data = filtered_data.filter( _almacen =>{
                    return _almacen.almacen_destino === this.movimiento_almacen.filters.almacen_destino;
                });
            }
            this.movimiento_almacen.paginated.pageNumber = 0;
            this.movimiento_almacen.data_with_filters=filtered_data;
        },
        //</editor-fold>
        //<editor-fold desc="Methods paginated">
        nextPage(){
            this.movimiento_almacen.paginated.pageNumber++;
        },

        prevPage(){
            this.movimiento_almacen.paginated.pageNumber--;
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
        exportPdf() {
            const doc = new jsPDF('p','mm', 'letter', true);
            doc.autoTable({html: '#print-movimientos'});
            doc.save('table.pdf');
        },
        print(){
            window.print();
        },
        */
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
    },
    computed: {
        /*pageCount: function(){
            let l = this.movimiento_almacen.data_with_filters.length,
                s = this.movimiento_almacen.paginated.size;
            return Math.ceil(l/s);
        },
        paginatedData: function(){
            const start = this.movimiento_almacen.paginated.pageNumber * this.movimiento_almacen.paginated.size,
                end = start + this.movimiento_almacen.paginated.size;
            return this.movimiento_almacen.data_with_filters
                .slice(start, end);
        },*/
    }
});