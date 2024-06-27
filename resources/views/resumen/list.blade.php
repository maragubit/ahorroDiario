<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ahorro diario
        </h2>
</x-slot>
<br>
<div>
<form class="container" method="post" action="{{route('resumen.listFilter')}}">
    @csrf
<div class="mb-3">
    <label for="FechaIni">Desde: </label>
    <input type="date" name="fechaIni" class="date-picker" />
    <label for="fechaFin">Hasta: </label>
    <input type="date" name="fechaFin" class="date-picker" />
    <button class="btn btn-success" type="submit">Filtrar</button>
</div>
</form>
</div>
</x-app-layout>