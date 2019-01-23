Vue.component('AppDates', {
    template:
        `
        <div class="input-group">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="dateStart">Fecha Inicio</label>
                                        </div>
                                        <input @change="selectedDate($event,1)" type="date" class="form-control pb-1" id="dateStart"
                                                   v-model="date_range.date1">
                                        <div class="input-group-prepend">
                                            <label class="input-group-text" for="dateEnd" >Fecha Fin</label>
                                        </div>
                                        <input @change="selectedDate($event,2)" type="date" class="form-control pb-1" id="dateEnd"
                                                   v-model="date_range.date2">
                                        <div class="input-group-prepend">
                                           <a href="javascript:void(0)" @click="submitDates" title="Buscar"
                                                class="btn btn-outline-secondary"
                                                ><i class="fas fa-search"></i>
                                                </a>
                                        </div>                                        
        </div>
        `,
    data() {
        return {
            date_range:'',
        }
    } ,
    created(){
        this.today();
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
            this.date_range = {
                date1 : year + '-' + month + '-' + day,
                date2 : year + '-' + month + '-' + day
            };
        },
        selectedDate(event, numericDate) {
            if (numericDate === 1) {
                if  (new Date(event.target.value).getTime() > new Date(this.date_range.date2).getTime()) {
                    this.date_range.date1 = event.target.value;
                    this.date_range.date2 = event.target.value;
                } else {
                    this.date_range.date1 = event.target.value;
                }
            } else {
                if  (new Date(event.target.value).getTime() < new Date(this.date_range.date1).getTime()) {
                    this.date_range.date1 = event.target.value;
                    this.date_range.date2 = event.target.value;
                } else {
                    this.date_range.date2 = event.target.value;
                }
            }
            this.$emit('date-range', this.date_range);
        },
        submitDates(){
            this.$emit('date-range', this.date_range);
        }
    },

});