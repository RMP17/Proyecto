var appCompra = new Vue({
    el: '#app-caja',
    data: {
        caja: {
            hideSuggestions:false,
            summary:null,
            data: [],
            registro:{
                data:[],
                paginated: {
                    size: 15,
                    pageNumber: 0,
                },
                data_with_filters:[],
                hideFilters:false,
                filters:{
                    caja:'',
                },
            },
            oneCaja:null,
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
            },
            caja_chica:{
                monto:null,
                diferencia:null,
                observaciones:null,
            },
            gasto: {
                hideFilters:false,
                attributes: {
                    id: null,
                    monto: null,
                    descripcion: ''
                },
                model: {
                    id: null,
                    monto: null,
                    descripcion: ''
                },
                data:[],
                data_with_filters:[],
                paginated: {
                    size: 15,
                    pageNumber: 0,
                },
                filters:{
                    empleado:'',
                    almacen:'',
                    cliente:''
                },
            },
        },
        configCaja:{
            url:urlGlobal.suggestionsOfCajas,
            placeholder:'Nombre de la Caja',
            variableForSuggestions:'nombre',
            variableForSuggestionsId:'id_caja'
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
            this.getCaja();
            this.getSummary();
        })
    },
    methods: {
        //<editor-fold desc="Methods of Caja">
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
            doc.autoTable({html: '#print-gastos'});
            doc.save('table.pdf');
        },
        exportPdfCajasChicas() {
            const doc = new jsPDF('l','mm', 'letter', true);
            doc.autoTable({html: '#print-cajas'});
            doc.save('table.pdf');
        }
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