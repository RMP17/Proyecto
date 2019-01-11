<div class="row">
    <div class="col-md-12">
        @include('pais.create')
    </div>
</div>
<div class="row ">
    <div class="col-md-2 offset-10 pl-0">
        <app-online-suggestions :config="pais.config"
                                @selected-suggestion-event="getPaisById">
        </app-online-suggestions>
    </div>
</div>
