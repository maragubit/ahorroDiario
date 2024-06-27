<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\GastoFijo;
use App\Models\IngresoFijo;
use App\Models\Ahorro;
use App\Models\Gasto;
use App\Models\Ingreso;
use DateTime;

class IndexController extends Controller
{
    public function index(){
        $user=auth()->user()->id;
        $mes = Carbon::now()->month;
        
        // Create a DateTime object for the current date
        $currentDate = new DateTime();
    
        // Clone the current date and set it to the first day of the next month
        $endOfMonth = clone $currentDate;
        $endOfMonth->modify('first day of next month');//cadena que procesa php
        
        // Calculate the difference in days
        $interval = $currentDate->diff($endOfMonth);
        
        // Return the number of days left in the current month
        $daysleft= $interval->days;
        
        //gastos fijos del usuario en este mes
        $gastosFijos= GastoFijo::whereMonth('created_at', $mes)->where('user_id', $user)->sum('cantidad');

        //ingresos fijos del usuario en este mes
        $ingresosFijos= IngresoFijo::whereMonth('created_at', $mes)->where('user_id', $user)->sum('cantidad');

        //gastos no fijos mensuales
        $gastoMensual=Gasto::whereMonth('created_at', $mes)->where('user_id', $user)->sum('cantidad');
        
        //ingresos no fijos mensuales
        $ingresoMensual=Ingreso::whereMonth('created_at', $mes)->where('user_id', $user)->sum('cantidad');
        
        //último ahorro establecido por el usuario
        $ahorro= Ahorro::where('user_id', $user)->orderBy('created_at', 'desc')->first();
        $ahorro = $ahorro->cantidad ?? 0;
        
        //dinero disponible por el usuario
        $disponible=$ingresosFijos-$gastosFijos-$ahorro-$gastoMensual+$ingresoMensual;

        //disponible hoy--- Dinero que se dispone al empezar el día, hora 00.00
        $gastosHoy=Gasto::whereDate('created_at', Carbon::today())->where('user_id', $user)->sum('cantidad');
        $ingresosHoy=Ingreso::whereDate('created_at', Carbon::today())->where('user_id', $user)->sum('cantidad');
        $balanceHoy=$ingresosHoy-$gastosHoy;
        $disponibleHoy=($disponible-$balanceHoy)/$daysleft;
        $disponibleDias=($disponible-$balanceHoy)/$daysleft; //dinero disponible por día sin contar balance hoy
        if($disponibleHoy+$balanceHoy<0){
            $disponibleDias=$disponible/$daysleft; //si gastamos más de la cuenta, actualizamos lo que queda por
        }

        
        $context=[
            'gastosFijos'=> $gastosFijos, //gastos fijos usuario este mes
            'ingresosFijos'=> $ingresosFijos, //ingresos fijos usuario este mes
            'ahorro'=> $ahorro, //ahorro establecido por el usuario
            'disponible'=>$disponible, //dinero disponible para gastar
            'gastoMensual'=>$gastoMensual, //acumulación de gastos no fijos en este mes por el usuario
            'ingresoMensual'=>$ingresoMensual, //acumulación de ingresos no fijos en este mes por el usuario
            'balanceHoy'=>$balanceHoy, //diferencia entre gastos e ingresos hoy
            'disponibleHoy'=>$disponibleHoy, //punto de partida para gastar hoy (Objetivo)
            'disponibleDias'=>$disponibleDias, // de lo que queda, si hoy no lo he gastado todo, cuanto podré gastar al día.
        ];
        return view('dashboard',$context);
    }
}
