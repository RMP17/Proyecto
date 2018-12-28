var shared = {
    categorias:{},
    fabricantes:{},
    empleados:{}
};

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