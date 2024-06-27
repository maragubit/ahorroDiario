<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ahorro diario
        </h2>
    </x-slot>
    <br>
    <br>
    <br>
    <form class="container" style="max-width:500px" method="post" action="{{ empty($gasto) ? route('gastosFijos.save'): route('gastosFijos.update',$gasto) }}">
    @csrf   
    @if (empty($gasto))
        @method ('post')
    @else
        @method ('put')    
    @endif    
    <div class="mb-3">
            <label for="concepto" class="form-label">Concepto</label>
            <input type="text" class="form-control" id="concepto" placeholder="Hipoteca.." name="concepto" @if (!empty($gasto)) value='{{$gasto->concepto}}' @endif>
            </div>
        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad"  step='0.01'  name="cantidad"  @if (!empty($gasto)) value='{{$gasto->cantidad}}' @endif>
        </div>
        <button style="float:left;max-width:300px;" type="submit" class="btn btn-danger btn-lg"> @if (empty($gasto)) Crear gasto fijo @else Editar gasto fijo @endif</button>
    </form>
</x-app-layout>