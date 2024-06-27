<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ahorro diario
        </h2>
    </x-slot>
    <br>
    <br>
    <br>
    <form class="container" style="max-width:500px" method="post" action="{{ empty($ingreso) ? route('ingresos.save'): route('ingresos.update',$ingreso) }}">
    @csrf   
    @if (empty($ingreso))
        @method ('post')
    @else
        @method ('put')    
    @endif    
    <div class="mb-3">
            <label for="concepto" class="form-label">Concepto</label>
            <input type="text" class="form-control" id="concepto" placeholder="Super mercado.." name="concepto" @if (!empty($ingreso)) value='{{$ingreso->concepto}}' @endif>
            </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad"  step='0.01'  name="cantidad"  @if (!empty($ingreso)) value='{{$ingreso->cantidad}}' @endif>
        </div>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha"  name="fecha"  @if (!empty($ingreso)) value='{{$ingreso->created_at}}' @endif>
        </div>
        <button style="float:left;max-width:300px;" type="submit" class="btn btn-success btn-lg"> @if (empty($ingreso)) Crear ingreso @else Editar ingreso  @endif</button>
    </form>
</x-app-layout>