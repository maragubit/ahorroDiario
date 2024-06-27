<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ahorro diario
        </h2>
    </x-slot>
    <br>
    @if($ahorro)
        <div class="container">
            <h1>Ahorro establecido</h1>
            <table class="table table-striped">
                <tr> <th>Cantidad</th> <th>Fecha</th><th>Borrar</th> </tr>
            <tr> <td>{{$ahorro->cantidad}}</td> <td>{{$ahorro->created_at}}</td> <td><a href="{{route('ahorros.delete',$ahorro)}}"><i class="fa fa-trash" aria-hidden="true"></i></a></td></tr>
            </table>
            <!-- Otros campos de ahorro -->
        </div>
    @else
    <br>
        <div class="container-fluid">
            <h1>No hay registro de ahorro</h1>
            <br>
            <h2>Dinero total: {{$balance}}€</h2>
            <h2 id="disponible">Disponible mensual según ahorro establecido: {{$balance}}€</h2>  
            <form method="post" action="{{route('ahorros.save')}}">
                @csrf
                <label for="customRange3" class="form-label">Cantidad a ahorrar: <span id="valBox"></span></label>
                <input type="range" class="form-control" oninput="showVal(this.value)" min="0" max="{{$balance}}" step="10" id="customRange3" name="cantidad">
                <button class="btn btn-success" type="submit">Crear</button>
            </form>

        </div>
    @endif

<script>
    function showVal(newVal){
    document.getElementById("valBox").innerHTML=newVal+"€";
    let total= {{$balance}}-newVal;
    document.getElementById('disponible').innerHTML="Disponible mensual según ahorro establecido: "+ total + "€";
    }

</script>
</x-app-layout>