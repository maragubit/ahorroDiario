<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ahorro diario
        </h2>
</x-slot>
<br>
<div class="container">
<form method="post" action="{{route('resumen.listFilter')}}">
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
<div class="container">
    <h3>Desde: {{$fechaIni}} Hasta:{{$fechaFin}}</h3>
    <h3>Último ahorro establecido: @if (!empty($ahorro)){{$ahorro}}€ @else Sin definir @endif</h3>
    <h3>Balance: @if (!empty($balance)){{$balance}}€ @else Sin definir @endif</h3>
    <h3>Disponible para gastar: @if (!empty($gastar)){{$gastar}}€ @else Sin definir @endif</h3>

<br>
<h1 class="h1">Ingresos</h1>
<table class="table table-striped">
    <tr> <th>Concepto</th> <th>Cantidad</th> <th>Fecha</th> <th>Editar</th> <th>Borrar</th> </tr>
@forelse ($ingresos as $ingreso)
    <tr> <td>{{$ingreso->concepto}}</td> <td>{{$ingreso->cantidad}}€</td> <td>{{$ingreso->created_at}}</td> <td><a href="{{route('ingresos.edit',$ingreso)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>  <td><a href="{{route('ingresos.delete',$ingreso)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>
@empty
@if (!empty ($ingresosTotal))<tr style="font-weight:bold"><td>Total:</td> <td>{{$ingresosTotal}}€</td></tr>@endif
No hay registros
@endforelse
</table>
<hr>
<br>
<h1 class="h1">Gastos</h1>
<table class="table table-striped">
    <tr> <th>Concepto</th> <th>Cantidad</th> <th>Fecha</th> <th>Editar</th> <th>Borrar</th> </tr>
@forelse ($gastos as $gasto)
    <tr> <td>{{$gasto->concepto}}</td> <td>{{$gasto->cantidad}}€</td> <td>{{$gasto->created_at}}</td> <td><a href="{{route('gastos.edit',$gasto)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>  <td><a href="{{route('gastos.delete',$gasto)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>
@empty
@if (!empty ($gastosTotal))<tr style="font-weight:bold"><td>Total:</td> <td>{{$gastosTotal}}€</td></tr>@endif
No hay registros
@endforelse
<tr style="font-weight:bold"><td>Total:</td> <td>{{$gastosTotal}}€</td></tr>
</table>
<hr>
<br>
<h1 class="h1">Ingresos Fijos</h1>
<table class="table table-striped">
    <tr> <th>Concepto</th> <th>Cantidad</th> <th>Fecha</th> <th>Editar</th> <th>Borrar</th> </tr>
@forelse ($ingresosFijos as $ingresoF)
    <tr> <td>{{$ingresoF->concepto}}</td> <td>{{$ingresoF->cantidad}}€</td> <td>{{$ingresoF->created_at}}</td> <td><a href="{{route('ingresosFijos.edit',$ingresoF)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>  <td><a href="{{route('ingresosFijos.delete',$ingresoF)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>
@empty
No hay registros
@endforelse
@if (!empty ($ingresosFijosTotal))<tr style="font-weight:bold"><td>Total:</td> <td>{{$ingresosFijosTotal}}€</td></tr>@endif
</table>
<hr>
<br>
<h1 class="h1">Gastos Fijos</h1>
<table class="table table-striped">
    <tr> <th>Concepto</th> <th>Cantidad</th> <th>Fecha</th> <th>Editar</th> <th>Borrar</th> </tr>
@forelse ($gastosFijos as $gastoF)
    <tr> <td>{{$gastoF->concepto}}</td> <td>{{$gastoF->cantidad}}€</td> <td>{{$gastoF->created_at}}</td> <td><a href="{{route('gastosFijos.edit',$gastoF)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>  <td><a href="{{route('gastosFijos.delete',$gastoF)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>
@empty
No hay registros
@endforelse
@if (!empty ($gastosFijosTotal))<tr style="font-weight:bold"><td>Total:</td> <td>{{$gastosFijosTotal}}€</td></tr>@endif
</table>
</div>
</x-app-layout>