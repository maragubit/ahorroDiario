<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ahorro;
use App\Models\Gasto;
use App\Models\Ingreso;
use App\Models\IngresoFijo;
use App\Models\GastoFijo;


class ResumenController extends Controller
{
    public function list()
    {
        return view ('resumen.list');
    }

    public function listFilter(Request $request)
    {
        $user=auth()->user()->id;
        $fechaIni=$request->post('fechaIni');
        $fechaFin=$request->post('fechaFin');
        $gastos=Gasto::where('user_id',$user)->whereBetween('created_at', [$fechaIni, $fechaFin])->get();
        $gastosTotal=Gasto::where('user_id',$user)->whereBetween('created_at', [$fechaIni, $fechaFin])->sum('cantidad');
        $ingresos=Ingreso::where('user_id',$user)->whereBetween('created_at', [$fechaIni, $fechaFin])->get();
        $ingresosTotal=Ingreso::where('user_id',$user)->whereBetween('created_at', [$fechaIni, $fechaFin])->sum('cantidad');
        $gastosFijos=GastoFijo::where('user_id',$user)->whereDate('created_at','<',$fechaFin)->get();
        $ingresosFijos=IngresoFijo::where('user_id',$user)->whereDate('created_at','<',$fechaFin)->get();
        $gastosFijosTotal=GastoFijo::where('user_id',$user)->whereDate('created_at','<',$fechaFin)->sum('cantidad');
        $ingresosFijosTotal=IngresoFijo::where('user_id',$user)->whereDate('created_at','<',$fechaFin)->sum('cantidad');
        $ahorro=Ahorro::where('user_id',$user)->whereDate('created_at','<',$fechaFin)->orderBy('created_at', 'desc')->first()->cantidad;
        $balance=$ingresosTotal+$ingresosFijosTotal-$gastosTotal-$gastosFijosTotal;
        $gastar=$balance-$ahorro;
        $contexto=[
            'ingresos'=>$ingresos,
            'gastos'=>$gastos,
            'gastosTotal'=>$gastosTotal,
            'ingresosTotal'=>$ingresosTotal,
            'gastosFijos'=>$gastosFijos,
            'ingresosFijos'=>$ingresosFijos,
            'gastosFijosTotal'=>$gastosFijosTotal,
            'ingresosFijosTotal'=>$ingresosFijosTotal,
            'ahorro'=>$ahorro,
            'balance'=>$balance,
            'gastar'=>$gastar,
            'fechaIni'=>$fechaIni,
            'fechaFin'=>$fechaFin,
        ];

        return view ('resumen.listFilter',$contexto);
    }
}
