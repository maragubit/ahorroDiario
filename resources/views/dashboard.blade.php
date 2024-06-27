<style>
    #calendar {
      border-collapse: collapse;
      width : 100%;
      padding-left:5%;
      padding-right:5%;
      background-image: url("{%static 'fondo.jpg' %}");
      overflow-x: scroll;
    }

    #calendar th, #calendar td {
      border: 1px solid #ddd;
      padding: 1%;
      text-align: center;
    }

    #calendar th {
      background-color: #494b4d;
      color: #fff;
    }

    #calendar td {
      cursor: pointer;
    }

    #calendar .today {
      background-color: #899ba7c2;
      color: black;
    }
    #mes{
      display: inline-block;
      text-align: center;
      width:100%;
    }

    .past-day span{
    color: #8888885c;
    text-decoration: line-through;
    }

    #ahorroForma{
        border: solid 2px grey;
        border-radius: 5px;
        background-color: #a5b3bc;
        padding-left:5px;
        margin-left:25px;
    }

    .btn-danger {
    color: #fff;
    background-color: #a5101e !important; 
    border-color: #a5101e !important;

    }
    .btn-success {
    color: #fff;
    background-color: #217c36 !important;
    border-color: #217c36 !important;
    }
  
</style>   
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Ahorro diario
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="table table-striped" style="max-width:700px">
                        <tr>
                            <th>Bienvenido: {{Auth::user()->name}}</th> <th style="color:red">@if ($ahorro==0) Por favor, edite los ingresos/gastos fijos y establezca un ahorro @endif</th> <th></th>
                        </tr>

                        <tr>
                            <td>Ahorro establecido: {{$ahorro}}€</td> <td>Disponible por mes: {{$disponible}}€</td> <td>Ingresos Fijos: {{$ingresosFijos}}€</td>
                        </tr>

                        <tr>
                             
                        </tr>

                        <tr>
                            <td>Gastos fijos: {{$gastosFijos}}€</td><td>Ingresos acumulados: {{$ingresoMensual}}€</td> <td>Gastos acumulados: {{$gastoMensual}}€</td>
                        </tr>

                        <tr>
                            <td id="hoy"></td> <td>Balance Hoy: {{$balanceHoy}}€</td>
                        </tr>
                    
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br>

<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-6"><h2 id="mes"></h2></div>
        <div class="col"></div>
    </div>
</div>
<br>
<table class="table-responsive-md" id="calendar">

    <thead>
    <tr>

        <th>Lunes</th>
        <th>Martes</th>
        <th>Miércoles</th>
        <th>Jueves</th>
        <th>Viernes</th>
        <th>Sábado</th>
        <th>Domingo</th>

    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<br>
<div clas="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-8" style="text-align:center;">
            <a href="{{route('gastos.create')}}"><button style="float:left; width:49%;" type="button" class="btn btn-danger btn-lg">Gasto -</button></a>
            <a href="{{route('ingresos.create')}}"><button style="float:left;width:49%;" type="button" class="btn btn-success btn-lg">Ingreso +</button></a>
        </div>
        <div class="col"></div>
    </div>
</div>
<br>
</x-app-layout>
<script>
/* FUNCION GENERACION CALENDARIO */
 document.addEventListener('DOMContentLoaded', function() {
    const calendarBody = document.querySelector('#calendar tbody');
    const today = new Date();
    let currentMonth = today.getMonth();
    let currentYear = today.getFullYear();

    function renderCalendar() {
      // Limpiar el cuerpo del calendario antes de renderizar
      calendarBody.innerHTML = '';

      // Obtener el primer día del mes y el número de días en el mes
      const firstDay = new Date(currentYear, currentMonth, 1);
      const lastDay = new Date(currentYear, currentMonth + 1, 0);
      const totalDays = lastDay.getDate();

      // Rellenar los días anteriores si el primer día no es domingo
      for (let i = 1; i < firstDay.getDay(); i++) {
        const cell = document.createElement('td');
        calendarBody.appendChild(cell);
      }

      // Rellenar los días del mes, y poner el gasto diario permitido
      for (let day = 1; day <= totalDays; day++) {
        const cell = document.createElement('td'); //creamos object html td
        let numeroDiaSpan=document.createElement("span");
        numeroDiaSpan.style.fontSize="85%";
        numeroDiaSpan.style.float="inline-start";
        let gastoSpan=document.createElement("span"); //creamos object html span
        gastoSpan.style.fontSize="110%";
        gastoSpan.style.float="inline-end";
        let balanceSpan=document.createElement("p"); //creamos object html p
        const gastoDiario = {{$disponibleDias}};

        if ( day==today.getDate() ){
            numeroDiaSpan.textContent = day;
            const balance={{$balanceHoy}};
            const disponibleHoy={{$disponibleHoy}};
            const total=(disponibleHoy+balance).toFixed(2);
            let objetivoHoy=document.getElementById("hoy");
            objetivoHoy.innerHTML="Objetivo hoy: "+disponibleHoy.toFixed(2)+"€";
            gastoSpan.innerHTML=" "+total+"€";
            gastoSpan.style.fontWeight="bold";
            balanceSpan.innerHTML=balance+"€";
            balanceSpan.style.fontSize="0.85em"
            total<0 ? gastoSpan.style.color="red" : gastoSpan.style.color="green";
            cell.appendChild(numeroDiaSpan);
            cell.appendChild(gastoSpan);
            cell.appendChild(balanceSpan);
            calendarBody.appendChild(cell);
        }
        else {
            numeroDiaSpan.textContent = day;
            gastoSpan.innerHTML=" "+gastoDiario.toFixed(2)+"€";
            cell.appendChild(numeroDiaSpan);
            cell.appendChild(gastoSpan);
            calendarBody.appendChild(cell);
        }

        // Resaltar el día actual
        if (
          day === today.getDate() &&
          currentMonth === today.getMonth() &&
          currentYear === today.getFullYear()
        ) {
          cell.classList.add('today');
        }

        // Marcar como borroso los días pasados
        if (
          (currentMonth < today.getMonth() || (currentMonth === today.getMonth() && day < today.getDate())) ||
          currentYear < today.getFullYear()
        ) {
          cell.classList.add('past-day');
        }

        // Cambiar de fila después de cada sábado (7 días)
        if ((day + firstDay.getDay()+6) % 7 === 0) {
          calendarBody.appendChild(document.createElement('tr'));
        }
      }
    }
    renderCalendar();

   /*  // Evento para avanzar al mes siguiente
    document.getElementById('calendar').addEventListener('click', function(event) {
      if (event.target.tagName === 'TD') {
        const selectedDay = parseInt(event.target.textContent);

        if (!isNaN(selectedDay)) {
          today.setDate(selectedDay);
          renderCalendar();
        }
      }
    }); */
  });

/* FUNCION GENERACION MES */

  function mes() {
    const mes = document.getElementById('mes');
    const today = new Date();
    const locale = 'es';
    mes.innerHTML = today.toLocaleString(locale, { month: "long" }).toUpperCase();
  }
  mes();
</script>
