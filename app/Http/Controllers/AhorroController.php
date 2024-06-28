<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ahorro;
use App\Models\GastoFijo;
use App\Models\IngresoFijo;

class AhorroController extends Controller
{
    public function index(){
        $user=auth()->user()->id;
        $ingresos=IngresoFijo::where('user_id',$user)->sum('cantidad');
        $gastos=GastoFijo::where('user_id',$user)->sum('cantidad');
        $ahorro=Ahorro::where('user_id',$user)->latest()->first();
        $context=[
            'ahorro'=>$ahorro,
            'ingresos'=>$ingresos,
            'gastos'=>$gastos,
            'balance'=>$ingresos-$gastos,
        ];
        return view ('ahorros.index',$context);
    }

    public function save(Request $request){
        $cantidad=$request->post('cantidad');
        $user=auth()->user()->id;
        Ahorro::create([
            'user_id'=>$user,
            'cantidad'=>$cantidad,
        ]);
        return redirect()->route('ahorros.index');
    }
    
    
    public function delete(Ahorro $ahorro){
        $this->authorize('delete',$ahorro);
        $ahorro->delete();
        return redirect()->route('ahorros.index');
    }
}
