var appMovimientoAlmacen = new Vue({
    el: '#app-medicion',
    data: {
        medicion: {
            hideFilters:false,
            hideSuggestions:false,
            /*hideFiltersSuggestions:false,*/
            data: [],
            cliente:{
                oneCliente:null,
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
            paginated: {
                size: 15,
                pageNumber: 0,
            },
            data_with_filters:[],
            filters:{
                empleado:'',
                cliente:'',
            },
            oneMedicion:null,
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
        configCiudad:{
            url:urlGlobal.suggestionsOfCiudades,
            placeholder:'Buscar por nombre de Ciudad',
            variableForSuggestions:'pais_ciudad',
            variableForSuggestionsId:'id_ciudad'
        },
        configCliente:{
            url:urlGlobal.getSuggestionsClientes,
            placeholder:'Nombre del cliente',
            variableForSuggestions:'razon_social',
            variableForSuggestionsId:'id_cliente'
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
            this.medicion.attributes.fecha_visita=this.toDateTimeLocal2(new Date(Date.now()));
        })
    },
    methods: {
        //<editor-fold desc="Methods of new cliente">
        registerCliente: function() {
            let inputs = this.medicion.cliente.attributes;
            axios.post(urlGlobal.resourcesCliente, inputs
            ).then(response => {
                this.medicion.cliente.attributes = Object.assign({},this.medicion.cliente.model);
                $('#modal-new-client').modal('hide');
                this.notificationSuccess();
            }).catch(errors => {
                console.log('errors');
                this.notificationErrors(errors);
            });

        },
        selectCiudad(response){
            if (response && response.id_ciudad) {
                this.medicion.cliente.attributes.id_ciudad = response.id_ciudad;
            }
        },
        //</editor-fold>
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
                this.medicion.cliente.oneCliente = response;
                this.$refs.txtNit.value=response.nit;
            } else {
                this.medicion.attributes.id_cliente = null;
                this.$refs.txtNit.value='';
            }
        },
        getClienteByNit: function(event){
            if (event.target.value === "") return;
            this.medicion.cliente.oneCliente = Object.assign({}, this.medicion.cliente.model);
            axios.get(urlGlobal.getClienteByNit+event.target.value)
                .then(response => {
                    if(response.data.id_cliente) {
                        this.medicion.cliente.oneCliente=response.data;
                        this.medicion.attributes.id_cliente = response.data.id_cliente;
                    } else {
                        this.medicion.cliente.oneCliente = Object.assign({}, this.medicion.cliente.model);
                        this.medicion.attributes.id_cliente = null;
                    }
                }).catch(errors => {
                console.log('errors');
            });
        },
        getMedicionesByRageDate(event){
            axios.post(urlGlobal.getMedicionByRangeDate, event
            ).then(response => {
                this.medicion.data = response.data;
                this.medicion.data_with_filters = this.medicion.data;
                this.medicion.paginated.pageNumber = 0;
            }).catch(errors => {
                console.log(errors);
            });
        },
        //<editor-fold desc="Methods of Mediciones">
        submitFormMedicion(){
            let date_visita=this.medicion.attributes.fecha_visita;
            let inputs = Object.assign({},this.medicion.attributes);
            if(inputs.fecha_visita){
                inputs.fecha_visita=this.toDateTimeLocal(new Date(date_visita));
            }
            axios.post(urlGlobal.resourcesMedicion, inputs
            ).then(response => {
                this.medicion.attributes.detalles=[];
                this.notificationSuccess();
            }).catch(errors => {
                this.notificationErrors(errors);
            });
        },
        //</editor-fold>
        removeMedicion(_medicion, index){
            let isConfirmed=confirm("¡¡¡Está seguro de eliminar la medicion!!!");
            if(isConfirmed){
                axios.delete(urlGlobal.resourcesMedicion+'/'+_medicion.id
                ).then(response => {
                    this.medicion.data.splice(index,1);
                    this.notificationSuccess();
                }).catch(errors => {
                    console.log(errors);
                });
            }
        },
        //<editor-fold desc="Methods of Filters">
        filterByEmpleado(empleado){
            if(empleado && empleado.nombre) {
                this.medicion.filters.empleado = empleado.nombre;
                this.goThroughFilters();
            }
        },
        filterByCliente(cliente){
            if(cliente && cliente.razon_social) {
                this.medicion.filters.cliente = cliente.razon_social;
                this.goThroughFilters();
            }
        },
        removeFilters(){
            this.medicion.filters.empleado='';
            this.medicion.filters.cliente='';
            this.medicion.hideFilters = true;
            this.medicion.paginated.pageNumber = 0;
            setTimeout(()=>this.medicion.hideFilters = false,0);
            this.goThroughFilters();
        },
        viewDetallesMedicion(medicion){
            this.medicion.oneMedicion = medicion;
        },
        printDetallesMedicion(medicion){
            this.medicion.oneMedicion = medicion;
            this.$nextTick(function () {
                this.print(this.$refs.print_medicion);
            });
        },
        goThroughFilters(){
            let filtered_data = this.medicion.data;
            if(this.medicion.filters.empleado.length>0){
                filtered_data = filtered_data.filter( _empleado =>{
                    return _empleado.empleado === this.medicion.filters.empleado;
                });
            }
            if(this.medicion.filters.cliente.length>0){
                filtered_data = filtered_data.filter( _cliente =>{
                    return _cliente.cliente === this.medicion.filters.cliente;
                });
            }
            this.medicion.paginated.pageNumber = 0;
            this.medicion.data_with_filters=filtered_data;
        },
        //</editor-fold>
        //<editor-fold desc="Methods paginated">
        nextPage(){
            this.medicion.paginated.pageNumber++;
        },

        prevPage(){
            this.medicion.paginated.pageNumber--;
        },
        //</editor-fold>

        toDateTimeLocal(datetime){
            let _datetime = datetime;
            ten= function (i) {
                return (i<10 ? '0':'')+i;
            };
            let YYYY=_datetime.getFullYear();
            let MM=ten(_datetime.getMonth()+1);
            let DD=ten(_datetime.getDate());
            let HH=ten(_datetime.getHours());
            let II=ten(_datetime.getMinutes());
            let SS=ten(_datetime.getSeconds());
            return YYYY + '-' + MM + '-' + DD + ' ' +
                HH + ':' + II + ':' + SS;
        },
        toDateTimeLocal2(datetime){
            let _datetime = datetime;
            ten= function (i) {
                return (i<10 ? '0':'')+i;
            };
            let YYYY=_datetime.getFullYear();
            let MM=ten(_datetime.getMonth()+1);
            let DD=ten(_datetime.getDate());
            let HH=ten(_datetime.getHours());
            let II=ten(_datetime.getMinutes());
            return YYYY + '-' + MM + '-' + DD + 'T' +
                HH + ':' + II;
        },
        exportPdf() {
            const doc = new jsPDF('p','mm', 'letter', true);
            doc.autoTable({html: '#print-medicion'});
            doc.save('mediciones.pdf');
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
        pageCount: function(){
            let l = this.medicion.data_with_filters.length,
                s = this.medicion.paginated.size;
            return Math.ceil(l/s);
        },
        paginatedData: function(){
            const start = this.medicion.paginated.pageNumber * this.medicion.paginated.size,
                end = start + this.medicion.paginated.size;
            return this.medicion.data_with_filters
                .slice(start, end);
        },
    }
});