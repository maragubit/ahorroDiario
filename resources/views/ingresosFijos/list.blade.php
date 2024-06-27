<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ahorro diario
        </h2>
    </x-slot>
    <br>
    <div><a href="{{route('ingresosFijos.create')}}"><button style="float:left;max-width:300px;" type="button" class="btn btn-success btn-lg">Crear ingreso fijo</button></a></div>
    <br>
    <br>
    <br>
    <div class="container" style="background-color:white">
        <table class="table table-striped">
            <tr> <th>Concepto</th> <th>Cantidad</th> <th>Fecha</th> <th></th> <th></th></tr>
            @forelse ($ingresosFijos as $ingreso)
            <tr> <td>{{$ingreso->concepto}}</td> <td>{{$ingreso->cantidad}}€</td> <td>{{$ingreso->created_at}}</td> <td><a href="{{route('ingresosFijos.edit',$ingreso)}}"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>  <td><a href="{{route('ingresosFijos.delete',$ingreso)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>
            @empty
            <tr><td>Sin registros</td></tr>
            @endforelse
        </table>
    </div>
</x-app-layout>
