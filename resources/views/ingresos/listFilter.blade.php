<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ahorro diario
        </h2>
</x-slot>
<br>
<div class="container">
<form method="post" action="{{route('ingresos.listFilter')}}">
    @csrf
<div class="mb-3">
    <label for="FechaIni">Desde: </label>
    <input type="date" name="fechaIni" class="date-picker" />
    <label for="fechaFin">Hasta: </label>
    <input type="date" name="fechaFin" class="date-picker" />
    <button class="btn btn-success" type="submit">Filtrar</button>
</div>
</form>
<br>
<table class="table table-striped">
    <tr> <th>Concepto</th> <th>Cantidad</th> <th>Fecha</th> <th>Editar</th> <th>Borrar</th> </tr>
@forelse ($ingresos as $ingreso)
    <tr> <td>{{$ingreso->concepto}}</td> <td>{{$ingreso->cantidad}}€</td> <td>{{$ingreso->created_at}}</td> <td><a href="{{route('ingresos.edit',$ingreso)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>  <td><a href="{{route('ingresos.delete',$ingreso)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>
@empty
No hay registros
@endforelse
</table>
</div>
</x-app-layout>