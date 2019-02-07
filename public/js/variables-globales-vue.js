const url = 'http://192.168.1.8:3000/Proyecto/public/';
var urlGlobal={
    resourcesCategorias:url + 'categoria',
    resourcesPais:url + 'pais',
    resourcesCiudad:url + 'ciudad',
    resourcesAlmacen:url + 'almacen',
    resourcesCargo:url + 'cargo',
    resourcesCompra:url + 'compra',
    resourcesMoneda:url + 'moneda',
    resourcesVenta:url + 'venta',
    resourcesCuenta:url + 'cuenta',
    resourcesCaja:url + 'caja',
    resourcesCuentaProveedor:url + 'cuenta-proveedor',
    resourcesProveedor:url + 'proveedor',
    resourcesFabricante:url + 'fabricante',
    resourcesEmpleado:url + 'empleado',
    resourcesEmpresa:url + 'empresa',
    resourcesContacto:url + 'contacto',
    resourcesGasto:url + 'gasto',
    resourcesSucursal:url + 'sucursal',
    postCompraCredito:url + 'compra/credito',
    postVentaCredito:url + 'venta/credito',
    postArticuPrecios:url + 'articulo/precios',
    getAllCiudades:url + 'ciudades',
    getKardex:url + 'kardex/',
    getCajas:url + 'cajas',
    closedAndOpenCashier:url + 'caja/closedAndOpenCashier',
    getCaja:url + 'caja/one',
    getSummary:url + 'caja/summary',
    getPermisos:url + 'permiso',
    resourcesAcceso:url + 'acceso',
    resourcesKardexObservaciones:url + 'kardexObservaciones',
    getAllSucursales:url + 'sucursales',
    getAllEmpleados:url + 'empleados',
    resourcesArticulo:url + 'articulo',
    getArticulos:url + 'articulo/all',
    getPreciosArticulo:url + 'articulo/precios/',
    getAllFabricantes:url + 'fabricantes',
    getAllCategorias:url + 'categorias',
    getArticuloForCodigo:url + 'articulo/codigo/',
    resourcesCliente:url + 'cliente',
    getSuggestionsClientes:url + 'cliente/suggestions/',
    getClienteByNit:url + 'cliente/nit/',
    getArticuloForId:url + 'articulo/id/',
    getArticuloForCodigoBarras:url + 'articulo/codigo-barras/',
    getArticuloForName:url + 'articulo/query/',
    changeStatusOfArticulo:url + 'articulo/status/',
    getPaisesByName:url + 'pais/query/',
    getComprasByRageDate:url + 'compra/date_range',
    getVentasByRageDate:url + 'venta/date_range',
    getGastoByRangeDate:url + 'gasto/date_range',
    getCajaChicaByRangeDate:url + 'caja/caja-chica/date_range',
    getPurchasesOnCreditInForce:url + 'compra/creditos',
    getSalesOnCreditInForce:url + 'venta/creditos',
    cancelSale:url + 'venta/cancel/',
    getCompraCredito:url + 'compra/creditos/',
    getVentaCredito:url + 'venta/creditos/',
    getPaisesById:url + 'pais/id/',
    getContactoOfProveedor:url + 'proveedor/contactos/',
    suggestionsOfCiudades:url + 'ciudades/',
    suggestionsOfProveedores:url + 'proveedores/',
    suggestionsOfContactos:url + 'contacto/suggestions/',
    suggestionsOfCajas:url + 'caja/suggestions/',
    simpleSuggestionsEmpleados:url + 'empleado/suggestions/',
    addCiudadToPais:url + 'pais/add-ciudad',
    addSucursalToEmpresa:url + 'empresa/add-suscursal/',
};

var shared = {
    categorias:{},
    fabricantes:{},
    empleados:{}
};

Vue.component('app-online-suggestions',{
    /*model:{
        prop:'selection',
        event:'input'
    },*/
    template: `
<div class="dropdown" @keydown.down='down' @keydown.up='up'
    @mouseenter="mouseOverSuggestions=true"
    @mouseleave="mouseOverSuggestions=false"
    >
    <!--(mouseout)="mouseOverSuggestions = false;"-->
    <input type="text" class="form-control" ref="suggestionInput" autocomplete="off"
           @input='change($event.target.value)'
           @keydown.enter='enter($event)'
           @keydown.tab='tab'
           @blur="onBlur"
           @keydown.esc='openSuggestions=false'
           :placeholder="config.placeholder || ''"
    >
    <div ref="listSeggestions" :class="{'show': openSuggestions}" class="dropdown-menu  m-0 w-100 cursor" aria-labelledby="dropdownMenuButton"
         onmousedown="return false;">
        <a v-for="(suggestion,index) in suggestions"
           :class="{'active': current === index }"
           class="dropdown-item"
           @click="suggestionClick(index)"
           @mousedown="indexChange(index)"
        >
            <span v-html="suggestion.detalleShow"></span>
        </a>
    </div>
</div>`,
    props:{
        config:{
            url:'',
            id:'',
            placeholder:{
                defailt:null
            },
            variableForSuggestions:{
                default: ''
            },
            variableForSuggestionsId:{
                default: ''
            },
        },
        inputValue:{
            default: null
        },
        isPersona:{
            default: false
        }
    },
    data(){
        return{
            openSuggestions: false,
            current: 0,
            suggestions: [],
            suggestionsTemp: [],
            idselection: '',
            inputObject: '',
            timeout:10,
            loadinput:'',
            selection:'',
            mouseOverSuggestions:false
        }
    },
    watch: {
        // whenever question changes, this function will run
        inputValue: function (newQuestion) {
            console.log(newQuestion);
            if(newQuestion) {
                this.$refs.suggestionInput.value = newQuestion;
                this.selection = newQuestion;
            } else if (newQuestion === '') {
                this.$refs.suggestionInput.value = '';
                this.selection = '';
            }
        }
    },
    methods:{
        cargar:async function(){
            /*function responseData(url,selection, variableForSuggestions, variableForSuggestionsId) {
                const promise = new Promise((resolve, reject) =>{
                    let datos = [];
                    clearTimeout(this.timeout);
                    this.timeout=setTimeout(function() {
                        axios.get(url+selection, {
                            timeout: 2000,
                        }).then(response=> {
                            if(response.data.length > 0)
                            {
                                response.data.forEach(respoTemp => {
                                    let textTempPosition = respoTemp[variableForSuggestions
                                        ].toLowerCase().indexOf(selection.toLowerCase());
                                    let textTemp = respoTemp[variableForSuggestions
                                        ].slice(textTempPosition, textTempPosition + selection.length);
                                    datos.push({
                                        'id': respoTemp[variableForSuggestionsId],
                                        'detalle': respoTemp[variableForSuggestions],
                                        'detalleShow': respoTemp[variableForSuggestions
                                            ].replace(new RegExp(textTemp, 'g'), textTemp.bold().big())
                                    });
                                });
                            }

                            resolve(datos);
                        }).catch(()=>{
                            reject(new Error('No existe un array'))
                        });
                    },0);
                });
                return promise;
            }*/

            let _suggestions=this.matches();
            if(_suggestions.length>0){
                this.suggestions = _suggestions;
            } else {
                axios.get(this.config.url+this.selection, {
                    timeout: 2000,
                }).then(response=> {
                    if(response.data.length > 0)
                    {
                        let datos = [];
                        response.data.forEach(respoTemp => {
                            let textTempPosition = respoTemp[this.config.variableForSuggestions
                                ].toLowerCase().indexOf(this.selection.toLowerCase());
                            let textTemp = respoTemp[this.config.variableForSuggestions
                                ].slice(textTempPosition, textTempPosition + this.selection.length);
                            datos.push({
                                'id': respoTemp[this.config.variableForSuggestionsId],
                                'detalle': respoTemp[this.config.variableForSuggestions],
                                'detalleShow': respoTemp[this.config.variableForSuggestions
                                    ].replace(new RegExp(textTemp, 'g'), textTemp.bold().big())
                            });
                        });
                        this.suggestionsTemp = datos;
                        this.suggestions = datos;
                    } else {
                        this.suggestions = [];
                        this.suggestionsTemp = [];
                    }
                })/*.catch(()=>{

            })*/;
            }

            /*this.suggestions = await responseData(this.config.url, this.selection,
                this.config.variableForSuggestions, this.config.variableForSuggestionsId);*/
        },
        enter(event){
            event.preventDefault();
            if(this.selection.length > 0 && this.openSuggestions) {
                if (this.suggestions.length !== 0) {
                    let temp = this.suggestions[this.current];
                    this.idselection = temp.id;
                    // responseTemp['ci'] = temp.ci;
                    this.$emit('selected-suggestion-event', temp);
                    this.current = 0;
                    this.selection = temp.detalle;
                    this.$refs.suggestionInput.value = temp.detalle;
                    this.openSuggestions = false;
                }
            }

        },
        tab() {
            if(this.idselection==='') {
                this.openSuggestions=false;
                // this.enter();
            }
        },
        up() {
            event.preventDefault();
            if(this.current > 0)
                this.current--;
            else
                this.current = this.suggestions.length - 1;
        },
        down() {
            event.preventDefault();

            if(this.current < this.suggestions.length - 1)
                this.current++;
            else
                this.current=0;
        },
        indexChange(index) {
            this.current = index;
        },
        change(valor){
            if (this.openSuggestions === false) {
                this.openSuggestions = true;
                this.current = 0;
                this.idselection ='';
            }
            this.selection=valor;
            if (valor.length > 0){
                this.$emit('selected-suggestion-event', null);
                this.cargar();
            } else {
                this.openSuggestions= false;
            }
        },
        suggestionClick:function(index) {
            let temp = this.suggestions[index];
            this.idselection = temp.id;
            this.selection = temp.detalle;
            this.$refs.suggestionInput.value=temp.detalle;
            this.$emit('selected-suggestion-event', temp);
            this.openSuggestions=false;
            this.current = 0;
            //corregir //this.selection = target[this.config.variableForSuggestions];
        },
        onBlur:function() {
            if (!this.mouseOverSuggestions) {
                this.openSuggestions = false;
            }
        },
        getCleanedString(string) {
            string = string.replace(/á/gi, 'a');
            string = string.replace(/é/gi, 'e');
            string = string.replace(/í/gi, 'i');
            string = string.replace(/ó/gi, 'o');
            string = string.replace(/ú/gi, 'u');
            string = string.replace(/ñ/gi, 'n');
            return string;
        },
        matches:function() {
            let aux = this.selection;
            let numero_suggestions=0;
            return this.suggestionsTemp.filter((str)=>{

                let textTempPosition=str.detalle
                    .toLowerCase().indexOf(aux.toLowerCase());

                let textTemp = str.detalle
                    .slice(textTempPosition, textTempPosition+aux.length);

                str.detalleShow=str.detalle
                    .replace(new RegExp(textTemp, 'g'),textTemp.bold().big());

                return this.getCleanedString(str.detalle).toLowerCase().indexOf(this.getCleanedString(aux).toLowerCase()) >=0;
            });
        },
    },
    computed:{
        /*matches:function() {
            let aux=this.selection;
            let numero_suggestions=0;
            return this.suggestions.filter((str)=>{
                let textTempPosition=str.detalle
                    .toLowerCase().indexOf(aux.toLowerCase());
                let textTemp = str.detalle
                    .slice(textTempPosition, textTempPosition+aux.length);
                str.detalleShow=str.detalle
                    .replace(new RegExp(textTemp, 'g'),textTemp.bold().big());
                return str.detalle.toLowerCase().indexOf(aux.toLowerCase()) >=0;
            });
        },*/
        /*openSuggestion:function() {
            return !this.selection
                && this.suggestions.length !== 0 && this.open === true;
        },*/
    },
});

// Compoenete de sugerencias que retorna un objecto

Vue.component('app-online-suggestions-objects',{
    /*model:{
        prop:'selection',
        event:'input'
    },*/
    template: `
<div class="dropdown" @keydown.down='down' @keydown.up='up'
    @mouseenter="mouseOverSuggestions=true"
    @mouseleave="mouseOverSuggestions=false"
    >
    <!--(mouseout)="mouseOverSuggestions = false;"-->
    <input type="text" class="form-control" ref="suggestionInput" autocomplete="off"
           @input='change($event.target.value)'
           @keydown.enter='enter($event)'
           @keydown.tab='tab'
           @blur="onBlur"
           @keydown.esc='openSuggestions=false'
           :placeholder="config.placeholder || ''"
    >
    <div ref="listSeggestions" :class="{'show': openSuggestions}" class="dropdown-menu  m-0 w-100 cursor" aria-labelledby="dropdownMenuButton"
         onmousedown="return false;">
        <a v-for="(suggestion,index) in suggestions"
           :class="{'active': current === index }"
           class="dropdown-item"
           @click="suggestionClick(index)"
           @mousedown="indexChange(index)"
        >
            <span v-html="suggestion.detalleShow"></span>
            <span v-if="suggestion.object.nit" class="float-right">{{suggestion.object.nit}}</span>
        </a>
    </div>
</div>`,
    props:{
        config:{
            url:'',
            id:'',
            placeholder:{
                defailt:null
            },
            variableForSuggestions:{
                default: ''
            },
            variableForSuggestionsId:{
                default: ''
            },
        },
        inputValue:{
            default: null
        },
        isPersona:{
            default: false
        }
    },
    data(){
        return{
            openSuggestions: false,
            current: 0,
            suggestions: [],
            suggestionsTemp: [],
            idselection: '',
            inputObject: '',
            timeout:10,
            loadinput:'',
            selection:'',
            mouseOverSuggestions:false
        }
    },
    watch: {
        // whenever question changes, this function will run
        inputValue: function (newQuestion) {
            if(newQuestion) {
                this.$refs.suggestionInput.value = newQuestion;
                this.selection = newQuestion;
            } else if (newQuestion === '') {
                this.$refs.suggestionInput.value = '';
                this.selection = '';
            }
        }
    },
    methods:{
        cargar:async function(){
            /*function responseData(url,selection, variableForSuggestions, variableForSuggestionsId) {
                const promise = new Promise((resolve, reject) =>{
                    let datos = [];
                    clearTimeout(this.timeout);
                    this.timeout=setTimeout(function() {
                        axios.get(url+selection, {
                            timeout: 2000,
                        }).then(response=> {
                            if(response.data.length > 0)
                            {
                                response.data.forEach(respoTemp => {
                                    let textTempPosition = respoTemp[variableForSuggestions
                                        ].toLowerCase().indexOf(selection.toLowerCase());
                                    let textTemp = respoTemp[variableForSuggestions
                                        ].slice(textTempPosition, textTempPosition + selection.length);
                                    datos.push({
                                        'id': respoTemp[variableForSuggestionsId],
                                        'detalle': respoTemp[variableForSuggestions],
                                        'detalleShow': respoTemp[variableForSuggestions
                                            ].replace(new RegExp(textTemp, 'g'), textTemp.bold().big())
                                    });
                                });
                            }

                            resolve(datos);
                        }).catch(()=>{
                            reject(new Error('No existe un array'))
                        });
                    },0);
                });
                return promise;
            }*/

            let _suggestions=await this.matches();
            if(_suggestions.length>0){
                this.suggestions = _suggestions;
            } else {
                axios.get(this.config.url+this.selection, {
                    timeout: 2000,
                }).then(response=> {
                    if(response.data.length > 0)
                    {
                        let datos = [];
                        response.data.forEach(respoTemp => {
                            let textTempPosition = respoTemp[this.config.variableForSuggestions
                                ].toLowerCase().indexOf(this.selection.toLowerCase());
                            let textTemp = respoTemp[this.config.variableForSuggestions
                                ].slice(textTempPosition, textTempPosition + this.selection.length);
                            datos.push({
                                'id': respoTemp[this.config.variableForSuggestionsId],
                                'detalle': respoTemp[this.config.variableForSuggestions],
                                'object': respoTemp,
                                'detalleShow': respoTemp[this.config.variableForSuggestions
                                    ].replace(new RegExp(textTemp, 'g'), textTemp.bold().big())
                            });
                        });
                        this.suggestionsTemp = datos;
                        this.suggestions = datos;
                    } else {
                        this.suggestions = [];
                        this.suggestionsTemp = [];
                    }
                })/*.catch(()=>{

            })*/;
            }

            /*this.suggestions = await responseData(this.config.url, this.selection,
                this.config.variableForSuggestions, this.config.variableForSuggestionsId);*/
        },
        enter(event){
            event.preventDefault();
            if(this.selection.length > 0 && this.openSuggestions) {
                if (this.suggestions.length !== 0) {
                    let temp = this.suggestions[this.current];
                    // responseTemp['ci'] = temp.ci;
                    this.$emit('selected-suggestion-event', temp.object);
                    this.current = 0;
                    this.selection = temp.detalle;
                    this.idselection = temp.id;
                    this.$refs.suggestionInput.value = temp.detalle;
                    this.openSuggestions = false;
                }
            }

        },
        tab() {
            if(this.idselection==='') {
                this.openSuggestions=false;
                // this.enter();
            }
        },
        up() {
            event.preventDefault();
            if(this.current > 0)
                this.current--;
            else
                this.current = this.suggestions.length - 1;
        },
        down() {
            event.preventDefault();

            if(this.current < this.suggestions.length - 1)
                this.current++;
            else
                this.current=0;
        },
        indexChange(index) {
            this.current = index;
        },
        change(valor){
            if (this.openSuggestions === false) {
                this.openSuggestions = true;
                this.current = 0;
                this.idselection ='';
            }
            this.selection=valor;
            if (valor.length > 0){
                this.$emit('selected-suggestion-event', null);
                this.cargar();
            } else {
                this.openSuggestions= false;
            }
        },
        suggestionClick:function(index) {
            let temp = this.suggestions[index];
            this.idselection = temp.id;
            this.selection = temp.detalle;
            this.$refs.suggestionInput.value=temp.detalle;
            this.$emit('selected-suggestion-event', temp.object);
            this.openSuggestions=false;
            this.current = 0;
            //corregir //this.selection = target[this.config.variableForSuggestions];
        },
        onBlur:function() {
            if (!this.mouseOverSuggestions) {
                this.openSuggestions = false;
            }
        },
        getCleanedString(string) {
            string = string.replace(/á/gi, 'a');
            string = string.replace(/é/gi, 'e');
            string = string.replace(/í/gi, 'i');
            string = string.replace(/ó/gi, 'o');
            string = string.replace(/ú/gi, 'u');
            string = string.replace(/ñ/gi, 'n');
            return string;
        },
        matches:function() {
            return new Promise((resolve, reject)=>{
                let aux = this.selection;
                let numero_suggestions=0;
                let suggestion = this.suggestionsTemp.filter((str)=>{

                    let textTempPosition=str.detalle
                        .toLowerCase().indexOf(aux.toLowerCase());

                    let textTemp = str.detalle
                        .slice(textTempPosition, textTempPosition+aux.length);

                    str.detalleShow=str.detalle
                        .replace(new RegExp(textTemp, 'g'),textTemp.bold().big());

                    return this.getCleanedString(str.detalle).toLowerCase().indexOf(this.getCleanedString(aux).toLowerCase()) >=0;
                });
                resolve(suggestion);
                }
            );
        },
    },
    computed:{
        /*matches:function() {
            let aux=this.selection;
            let numero_suggestions=0;
            return this.suggestions.filter((str)=>{
                let textTempPosition=str.detalle
                    .toLowerCase().indexOf(aux.toLowerCase());
                let textTemp = str.detalle
                    .slice(textTempPosition, textTempPosition+aux.length);
                str.detalleShow=str.detalle
                    .replace(new RegExp(textTemp, 'g'),textTemp.bold().big());
                return str.detalle.toLowerCase().indexOf(aux.toLowerCase()) >=0;
            });
        },*/
        /*openSuggestion:function() {
            return !this.selection
                && this.suggestions.length !== 0 && this.open === true;
        },*/
    },
});



/*
var sharedVariables = new Vue({
    el: '#app-shared',
    created(){
        this.getAllCategorias();
        this.getAllFabricantes();
        // this.getAllEmpleados();
    },
    
    methods: {
        getAllCategorias(){
            axios.get(urlGlobal.getAllCategorias)
                .then((response)=>{
                    shared.categorias=response.data;
                    appArticulo.categoria.allData=shared.categorias;
                }).catch((errors)=>{
                console.log(errors);
            });
        },
        getAllFabricantes(){
            axios.get(urlGlobal.getAllFabricantes)
                .then((response)=>{
                    shared.fabricantes=response.data;
                    appArticulo.fabricante.allData=shared.fabricantes;
                }).catch((errors)=>{
                console.log(errors);
            });
        },
        getAllEmpleados(){
            axios.get(urlGlobal.getAllEmpleados)
                .then((response)=>{
                    appEmpleado.empleado.allData=shared.empleados;
                }).catch((errors)=>{
                console.log(errors);
            });
        }
    }
});*/
