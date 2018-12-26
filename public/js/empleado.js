var appEmpleado = new Vue({
    el: '#app-empleado',
    data: {
        toggleEmpleadoKardex: true,
        errorsKardex: [],
       /* kardex: {
            id_kardex:null,
            dtm: '',
            txtDescripcion: '',
        },*/
    },
/*    methods: {
        registerCategoria: function() {
            let input = this.categoria;
            axios.post( urlGlobal+ 'categoria', input)
                .then((response)=>{
                    this.categoria = {
                        id_categoria: null,
                        txtCategoria: '',
                        txtDescripcion: '',
                    };
                    // $("#myModal").modal('hide');
                    // toastr.success(response.data, 'Alerta de Exito', {timeOut: 10000});
                }).catch(errors =>{
                    let _errors = errors.response.data.errors;
                    Object.keys(errors.response.data.errors).forEach( value => {
                        console.log(value);
                    });
                   this.errorsCategoria = errors.response.data.errors;
                });
        },
    }*/
})