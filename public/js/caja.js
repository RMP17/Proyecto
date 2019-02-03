var appCompra = new Vue({
    el: '#app-caja',
    data: {
        caja: {
            hideSuggestions:false,
            data: [],
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
            this.getCaja();
        })
    },
    methods: {
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