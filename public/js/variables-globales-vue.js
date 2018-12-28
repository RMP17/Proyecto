var shared = {
    categorias:{},
    fabricantes:{},
    empleados:{}
};

Vue.component('app-online-suggestions',{
    model:{
        prop:'selection',
        event:'input'
    },
    template: `
<div class="dropdown" @keydown.down='down' @keydown.up='up'
    @mouseenter="openSuggestions=true"
    @mouseleave="openSuggestions=false"
    >
    <!--(mouseout)="mouseOverSuggestions = false;"-->
    <input type="text" class="form-control" ref="suggestionInput"
           @input='change($event.target.value)'
           @keydown.enter='enter'
           @keydown.tab='tab'
           @blur="onBlur"
           @keydown.esc='open=false'
           :placeholder="config.placeholder || ''"
    >
    <div ref="listSeggestions" :class="{'show': open}" class="dropdown-menu  m-0 w-100 cursor" aria-labelledby="dropdownMenuButton"
         onmousedown="return false;">
        <a v-for="(suggestion,index) in suggestions"
           :class="{'active': indexElement === index }"
           class="dropdown-item"
           @click="suggestionClick(suggestion)"
           @mousedown="indexChange(index)"
        >
            <!--(mouseover)="indexChange(i)"-->
            <span>{{suggestion.detalle }}</span>
        </a>
    </div>
</div>
    <!--<div>
        <div>
            <div class="input-field">
                <input
                       onkeypress="return event.keyCode!=13"
                       autocomplete="off"
                       
                >
                <div v-if="open" class="collection collection-auto" style="z-index:1000;"
                     
                     onselectstart='return false'
                >
                    <a v-for="(suggestion,index) in suggestions"
                       :class="{'focus': isActive(index)}"
                       
                       onclick='return false' class="collection-item collection-auto-item"
                    >
                        <span v-if="isPersona" class="badge">@{{ suggestion.ci  }}</span><span
                                v-html="suggestion.detalleShow">@{{ suggestion.detalleShow }}</span>
                    </a>
                </div>
            </div>
        </div>
        <div :class="config.object=='nombre' ? 'col s2 padding-left':''" class="flex-container">
            <div v-if="config.selection['ci'] && config.object=='nombre'" class="fex-child-text">
                <div class="input-field">
                    <input disabled :value="config.selection['ci']" type="text"
                           class="validate input-autocompletes black-text center-align">
                </div>
            </div>
            <div v-else class="fex-child-text">
                <div class="input-field">
                    <input disabled type="text" class="validate input-autocompletes black-text">
                </div>
            </div>
        </div>
    </div>-->`,
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
            open: false,
            openSuggestions: false,
            current: 0,
            suggestions: [],
            idselection: '',
            inputObject: '',
            timeout:10,
            loadinput:'',
            selection:'',
            indexElement:0
        }
    },
    watch: {
        // whenever question changes, this function will run
        selection: function (newQuestion) {
            this.inputObject=this.variableForSuggestions;
            this.$set(this,'suggestions', []);

            if(newQuestion!==''){
                this.cargar();
            }
        }
    },
    methods:{
        cargar:async function(){
            function responseData(url,selection, variableForSuggestions, variableForSuggestionsId) {
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
            }

            this.suggestions = await responseData(this.config.url, this.selection,
                this.config.variableForSuggestions, this.config.variableForSuggestionsId);
        },
        enter(){
            if(this.idselection=='') {
                if(this.suggestions.length!=0){
                    var temp = this.suggestions[this.current];
                    this.idselection=temp.id;
                    responseTemp={};
                    responseTemp[this.objectid]=temp.id;
                    responseTemp[this.object]=temp.detalle;
                    responseTemp['ci']=temp.ci;
                    this.$emit('input', responseTemp);
                    this.open = false;
                    this.current=0;
                }
            }
        },
        tab() {
            if(this.idselection=='') {
                this.open = false;
                this.enter();
            }
        },
        up() {
            if(this.current > 0)
                this.current--;
        },

        down() {
            if(this.current < this.suggestions.length - 1)
                this.current++;
        },
        indexChange(index) {
            this.indexElement = index;
        },
        change(valor){
            if (this.open === false) {
                this.open = true;
                this.current = 0;
                this.idselection ='';
            }
            if (valor.length > 0){
                console.log(valor);
                this.selection=valor;
                this.cargar();
                //this.$emit('input', responseTemp);
            }
            //responseTemp={};
            //responseTemp=valor;
            //this.$emit('input', responseTemp);
        },
        suggestionClick:function(target) {
            this.idselection = target.id;
            this.selection = target.detalle;
            this.$refs.suggestionInput.value=target.detalle;
            this.$emit('selectedSuggestionEvent', target);
            this.open = false;
            this.openSuggestions=false;
            this.indexElement = 0;
            this.showSuggestions = false;
            //corregir //this.selection = target[this.config.variableForSuggestions];
        },
        /*mouseEnterLeave:function() {
         console.log(this.openSuggestions);
         },*/
        onBlur:function() {
            if(this.idselection=='') {
                if (this.openSuggestions == true) {
                    this.$refs.suggestionInput.focus();
                }
                else {
                    this.open = false;
                }
            }
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
        openSuggestion:function() {
            return !this.selection
                && this.suggestions.length !== 0 && this.open === true;
        },
    },
});

var sharedVariables = new Vue({
    el: '#app-shared',
    created(){
        this.getAllCategorias();
        this.getAllFabricantes();
        this.getAllEmpleados();
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
});