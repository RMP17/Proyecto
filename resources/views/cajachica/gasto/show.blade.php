@include('cajachica.gasto.create')
<table class="table table-striped table-bordered table-sm">
    <thead>
    <tr>
        <th>Fecha y hora</th>
        <th>Empleado</th>
        <th>Caja</th>
        <th>Monto</th>
        <th>Descripción</th>
    </tr>
    </thead>
    <tbody>
    {{--@foreach($gastos as $g)
        <tr>
            <td>{{ $g ->monto }}</td>
            <td>{{ $g ->descripcion }}</td>
        </tr>
    @endforeach--}}
    </tbody>
</table>