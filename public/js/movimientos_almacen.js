var appMovimientoAlmacen = new Vue({
    el: '#app-movimiento-almacen',
    data: {
        movimiento_almacen: {
            hideSuggestionsArticulo:false,
            hideFilters:false,
            hideFiltersSuggestions:false,
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
            filters:{
                empleado:'',
                almacen_origen:'',
                almacen_destino:'',
            },
            oneMovimientoAlmacen:null,
            detalle:{
                attributes:{
                    id_articulo:null,
                    nombre:null,
                    cantidad:null,
                },
                model:{
                    id_articulo:null,
                    nombre:null,
                    cantidad:null,
                }
            },
            attributes: {
                id:null,
                id_almacen_origen:null,
                id_almacen_destino:null,
                observaciones:null,
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
        configEmpleado:{
            url:urlGlobal.simpleSuggestionsEmpleados,
            placeholder:'Nombre del Empleado',
            variableForSuggestions:'nombre',
            variableForSuggestionsId:'id_empleado'
        },
    },
    mounted() {
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
        //<editor-fold desc="Methods of movimientos">
        selectStockAlmacen(id_almacen){
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
            this.movimiento_almacen.detalle.attributes.id_articulo=this.movimiento_almacen.articulo.one.id_articulo;
            this.movimiento_almacen.detalle.attributes.nombre=this.movimiento_almacen.articulo.one.nombre;
            if( this.movimiento_almacen.detalle.attributes.id_articulo
                && this.movimiento_almacen.detalle.attributes.cantidad
            ){
                let index = this.movimiento_almacen.attributes.detalles.findIndex(detalle => {
                    return detalle.id_articulo === this.movimiento_almacen.detalle.attributes.id_articulo;
                });
                if (index === -1) {
                    this.movimiento_almacen.attributes.detalles.push(this.movimiento_almacen.detalle.attributes);
                } else {
                    let movimiento_almacen = this.movimiento_almacen.attributes.detalles[index];
                    movimiento_almacen.cantidad += this.movimiento_almacen.detalle.attributes.cantidad;
                }
                this.movimiento_almacen.detalle.attributes = Object.assign({},this.movimiento_almacen.detalle.model);
                this.movimiento_almacen.articulo.one = Object.assign({},this.movimiento_almacen.articulo.model);
                this.movimiento_almacen.hideSuggestionsArticulo = true;
                setTimeout(()=>{this.movimiento_almacen.hideSuggestionsArticulo = false;},0);
            } else {
                let errors=[
                    '<li>El Árticulo es requerido</li>',
                    '<li>La cantidad es requerida</li>',
                ];
                toastr.error(errors, 'Revice los campos', {timeOut: 10000});
            }
        },
        removeOfList(index){
            this.movimiento_almacen.attributes.detalles.splice(index, 1);
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
                this.print(this.$refs.print_movimiento);
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
        print(element){
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
            let l = this.movimiento_almacen.data_with_filters.length,
                s = this.movimiento_almacen.paginated.size;
            return Math.ceil(l/s);
        },
        paginatedData: function(){
            const start = this.movimiento_almacen.paginated.pageNumber * this.movimiento_almacen.paginated.size,
                end = start + this.movimiento_almacen.paginated.size;
            return this.movimiento_almacen.data_with_filters
                .slice(start, end);
        },
    }
});