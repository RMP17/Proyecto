var appMovimientoAlmacen = new Vue({
    el: '#app-movimiento-almacen',
    data: {
        movimiento_almacen: {
            hideSuggestionsArticulo:false,
            articulo:{
                one:{
                    id_articulo:null,
                    categoria:null,
                    nombre:null,
                    fabricante:null,
                    stocks:[],
                    stock:null
                },
                model:{
                    id_articulo:null,
                    categoria:null,
                    fabricante:null,
                    stocks:[],
                    stock:null
                },
                tempNombre:null
            },
            data: [],
            paginated: {
                size: 15,
                pageNumber: 0,
            },
            data_with_filters:[],
            hideFilters:false,
            filters:{
                caja:'',
            },
            oneCaja:null,
            detalle:{
                id_articulo:null,
                nombre:null,
                cantidad:null,
            },
            attributes: {
                id:null,
                id_almacen_origen:null,
                id_almacen_destino:null,
                detalles:[]
            },
            model: {
                id:null,
                id_almacen_origen:null,
                id_almacen_destino:null,
                detalles:[]
            },
        },
        almacenes: [],
        configArticulo:{
            url:urlGlobal.getArticuloStockByName,
            placeholder:'Nombre del Artículo',
            variableForSuggestions:'nombre',
            variableForSuggestionsId:'id_articulo'
        },
    },
    created() {
        this.$nextTick(function () {
            this.getAlmacenes();
           /* this.getCajas();
            this.getCaja();
            this.getSummary();*/
        })
    },
    methods: {
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
                /*this.$refs.txtCantidad.select();*/
            } else {
                this.movimiento_almacen.articulo.one= Object.assign({},this.movimiento_almacen.articulo.model)
                this.$refs.input_articulo_codigo.value = '';
                this.$refs.input_articulo_codigo_barra.value = '';
            }
        },
        addToList(){
            // fixme:continuar, debes ajustar las variables de detalle y movimiento
            this.movimiento_almacen.attributes.id_articulo=this.movimiento_almacen.articulo.one.id_articulo;
            this.movimiento_almacen.attributes.nombre=this.movimiento_almacen.articulo.one.nombre;
            if( this.movimiento_almacen.attributes.id_articulo
                && this.movimiento_almacen.attributes.cantidad
                && this.movimiento_almacen.attributes.id_almacen_origen
                && this.movimiento_almacen.attributes.id_almacen_destino
            ){
                let index = this.movimiento_almacen.inputs.findIndex(detalle => {
                    return detalle.id_articulo === this.movimiento_almacen.attributes.id_articulo;
                });
                if (index === -1) {
                    this.movimiento_almacen.inputs.push(this.movimiento_almacen.attributes);
                } else {
                    let movimiento_almacen = this.movimiento_almacen.inputs[index];
                    movimiento_almacen.cantidad += this.movimiento_almacen.attributes.cantidad;
                }
                let id_almacen_destino= this.movimiento_almacen.attributes.id_almacen_destino;
                let almacen_destino= this.movimiento_almacen.attributes.almacen_destino;
                let id_almacen_origen= this.movimiento_almacen.attributes.id_almacen_origen;
                let almacen_origen= this.movimiento_almacen.attributes.almacen_origen;
                this.movimiento_almacen.attributes = Object.assign({},this.movimiento_almacen.model);
                this.movimiento_almacen.attributes.id_almacen_origen =id_almacen_origen;
                this.movimiento_almacen.attributes.almacen_origen =almacen_origen;
                this.movimiento_almacen.attributes.id_almacen_destino =id_almacen_destino;
                this.movimiento_almacen.attributes.almacen_destino =almacen_destino;
                this.movimiento_almacen.articulo.one = Object.assign({},this.movimiento_almacen.articulo.model);;
                this.movimiento_almacen.hideSuggestionsArticulo = true;
                setTimeout(()=>{this.movimiento_almacen.hideSuggestionsArticulo = false;},0.1);
            } else {
                let errors=[
                    '<li>El Árticulo es requerido</li>',
                    '<li>La cantidad es requerida</li>',
                    '<li>Almacén de origen es requerido</li>',
                    '<li>Almacén de destino es requerido</li>',
                ];
                toastr.error(errors, 'Revice los campos', {timeOut: 10000});
            }
        },
        removeOfList(index){
            this.movimiento_almacen.inputs.splice(index, 1);
        },
        selectNameAlmacen: function(almacen, tipoAsignacion){
            if(almacen.target.options.selectedIndex > -1) {
                let index = almacen.target.options.selectedIndex;
                if (tipoAsignacion==='origen') {
                    this.movimiento_almacen.attributes.almacen_origen = almacen.target.options[index].text;
                } else if(tipoAsignacion==='destino'){
                    this.movimiento_almacen.attributes.almacen_destino = almacen.target.options[index].text;
                }
            }
        },

        /*//<editor-fold desc="Methods of Caja">
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
        getCaja(){
            axios.get(urlGlobal.getCaja
            ).then(response => {
                this.caja.oneCaja=response.data;
            }).catch(errors => {
                console.log('errors');
                this.notificationErrors2(errors);
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
        closedAndOpenCashier(){
            let inputs = this.caja.caja_chica;
            axios.patch(urlGlobal.closedAndOpenCashier, inputs)
                .then(response => {
                    this.caja.caja_chica={
                        monto:null,
                        observaciones:null,
                    };
                    this.notificationSuccess();
                    this.getCaja();
                }).catch(errors => {
                this.notificationErrors2(errors);
            });
        },
        //</editor-fold>,
        getSummary(){
            axios.get(urlGlobal.getSummary
            ).then(response => {
                this.caja.summary = response.data;
            }).catch(errors => {
                console.log(errors);
            });
        },
        getCajaChicaByRangeDate(event){
            axios.post(urlGlobal.getCajaChicaByRangeDate, event
            ).then(response => {
                this.caja.registro.data = response.data;
                this.caja.registro.data_with_filters = this.caja.registro.data;
                this.caja.registro.paginated.pageNumber = 0;
            }).catch(errors => {
                console.log(errors);
            });
        },

        submitFormGasto(){
            let inputs = Object.assign({},this.caja.gasto.attributes);
            axios.post(urlGlobal.resourcesGasto, inputs
            ).then(response => {
                Object.assign(this.caja.gasto.attributes, this.caja.gasto.model);
                this.notificationSuccess();
            }).catch(errors => {
                this.notificationErrors(errors);
            });
        },
        getGastosByRangeDate(event){
            axios.post(urlGlobal.getGastoByRangeDate, event
            ).then(response => {
                this.caja.gasto.data = response.data;
                this.caja.gasto.data_with_filters = this.caja.gasto.data;
                this.caja.gasto.paginated.pageNumber = 0;
            }).catch(errors => {
                console.log(errors);
            });
        },

        //<editor-fold desc="Methods of Filters">
        filterByEmpleado(empleado){
            if(empleado && empleado.nombre) {
                this.caja.gasto.filters.empleado = empleado.nombre;
                this.goThroughFilters();
            }
        },
        filterByCaja(caja){
            if(caja && caja.nombre) {
                this.caja.registro.filters.caja = caja.nombre;
                this.registerOfBoxesPassGoThroughFilters();
            }
        },
        removeFilters(){
            this.caja.gasto.filters.empleado='';
            this.caja.gasto.hideFilters = true;
            this.caja.gasto.paginated.pageNumber = 0;
            setTimeout(()=>this.caja.gasto.hideFilters = false,1);
            this.goThroughFilters();
        },
        removeFiltersOfCaja(){
            this.caja.registro.filters.caja='';
            this.caja.registro.hideFilters = true;
            this.caja.registro.paginated.pageNumber = 0;
            setTimeout(()=>this.caja.registro.hideFilters = false,1);
            this.registerOfBoxesPassGoThroughFilters();
        },
        goThroughFilters(){
            let filtered_data = this.caja.gasto.data;
            if(this.caja.gasto.filters.empleado.length>0){
                filtered_data = filtered_data.filter( _empleado =>{
                    return _empleado.empleado === this.caja.gasto.filters.empleado;
                });
            }
            this.caja.gasto.paginated.pageNumber = 0;
            this.caja.gasto.data_with_filters=filtered_data;
        },
        registerOfBoxesPassGoThroughFilters(){
            let filtered_data = this.caja.registro.data;
            if(this.caja.registro.filters.caja.length>0){
                filtered_data = filtered_data.filter( _caja =>{
                    return _caja.caja === this.caja.registro.filters.caja;
                });
            }
            this.caja.registro.paginated.pageNumber = 0;
            this.caja.registro.data_with_filters=filtered_data;
        },

        //</editor-fold>

        //<editor-fold desc="Methods paginated">
        nextPage(){
            this.caja.gasto.paginated.pageNumber++;
        },
        nextPageOfCaja(){
            this.caja.registro.paginated.pageNumber++;
        },
        prevPage(){
            this.caja.gasto.paginated.pageNumber--;
        },
        prevPageOfCaja(){
            this.caja.registro.paginated.pageNumber--;
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
            doc.autoTable({html: '#print-gastos'});
            doc.save('table.pdf');
        },*/
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
    },
    computed: {
        pageCount: function(){
            let l = this.caja.gasto.data_with_filters.length,
                s = this.caja.gasto.paginated.size;
            return Math.ceil(l/s);
        },
        paginatedData: function(){
            const start = this.caja.gasto.paginated.pageNumber * this.caja.gasto.paginated.size,
                end = start + this.caja.gasto.paginated.size;
            return this.caja.gasto.data_with_filters
                .slice(start, end);
        },
        pageCountOfRegisterBox: function(){
            let l = this.caja.registro.data_with_filters.length,
                s = this.caja.registro.paginated.size;
            return Math.ceil(l/s);
        },
        paginatedRegisterBox: function(){
            const start = this.caja.registro.paginated.pageNumber * this.caja.registro.paginated.size,
                end = start + this.caja.registro.paginated.size;
            return this.caja.registro.data_with_filters
                .slice(start, end);
        }
    }
});