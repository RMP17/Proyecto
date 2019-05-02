var appEmpleado = new Vue({
    el: '#app-cliente',
    data: {
        cliente:{
            hideFilters:false,
            data_with_filters:[],
            paginated: {
                size: 15,
                pageNumber: 0,
            },
            one:null,
            queryFromStock:{
                date1:null,
                date2:null,
                id_cliente:null,
            }

        },
        configCliente:{
            url:urlGlobal.getSuggestionsClientes,
            placeholder:'Nombre del cliente',
            variableForSuggestions:'razon_social',
            variableForSuggestionsId:'id_cliente'
        },
    },
    mounted(){
        this.$nextTick(() => {
           this.cliente.queryFromStock.date1=this.cliente.queryFromStock.date2=this.today();
        });
    },
    methods: {
        today(){
            let date, year, month, day;
            date = new Date();
            year = date.getFullYear();
            if (date.getMonth() + 1 < 10) {
                month = '0' + (date.getMonth() + 1);
            } else {
                month = date.getMonth() + 1;
            }
            if (date.getDate() < 10) {
                day = '0' + date.getDate();
            } else {
                day = date.getDate();
            }
            return year + '-' + month + '-' + day;
        },
        getClientesByRageDate(e){
            console.log(e);
        },







        //<editor-fold desc="Methods of filtering">
        filterByCliente(e){
            console.log(e);
        },
        removeFilters(){

        },
        //</editor-fold>
        //<editor-fold desc="Methods paginated">
        nextPage(){
            this.cliente.paginated.pageNumber++;
        },
        prevPage(){
            this.cliente.paginated.pageNumber--;
        },
        //</editor-fold>
    },
    computed: {
        pageCount: function(){
            let l = this.cliente.data_with_filters.length,
                s = this.cliente.paginated.size;
            return Math.ceil(l/s);
        },
        paginatedData: function(){
            const start = this.cliente.paginated.pageNumber * this.cliente.paginated.size,
                end = start + this.cliente.paginated.size;
            return this.cliente.data_with_filters
                .slice(start, end);
        }
    }
});
