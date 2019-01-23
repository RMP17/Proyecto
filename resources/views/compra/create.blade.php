<div class="container-fluid">
    {{--<form class="form-horizontal" @submit.prevent_="submitFormMoneda">--}}
    <div class="card-group mb-0 ">
        <div class="card col-md-9 p-0">
            <div class="card-body p-0">
                <h5 class="card-title text-center">Detalle de la Compra</h5>
                @include('compra.forms.form_detalle_compra')
            </div>
        </div>
        <div class="card col-md-3 border-0">
            <div class="card-body p-0">
                <h5 class="card-title text-center">Datos de Compra</h5>
                @include('compra.forms.form_compra')
            </div>
        </div>
    </div>
    {{--</form>--}}
</div>
