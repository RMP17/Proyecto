var shared = {
    categorias:{},
    fabricantes:{}
};

var sharedVariables = new Vue({
    el: '#app-shared',
    created(){
        this.getAllCategorias();
        this.getAllFabricantes();
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
                    appArticulo.fabricante.allData=shared.fabricantes;
                }).catch((errors)=>{
                console.log(errors);
            });
        }
    }
});