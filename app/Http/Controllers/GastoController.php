<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto;
use Illuminate\Auth\Middleware\Authorize;

class GastoController extends Controller
{
    public function list()
    {
        return view ('gastos.list');
    }

    public function listFilter(Request $request)
    {
        $user=auth()->user()->id;
        $fechaIni=$request->post('fechaIni');
        $fechaFin=$request->post('fechaFin');
        $gastos=Gasto::where('user_id',$user)->whereBetween('created_at', [$fechaIni, $fechaFin])->get();
        return view ('gastos.listFilter')->with('gastos',$gastos);
    }
    
    
    public function create(){

        return view ('gastos.create');
    }

    public function save(Request $request){
        $concepto=$request->post('concepto');
        $cantidad=$request->post('cantidad');
        $fecha=$request->post('fecha');
        $user=auth()->user()->id;
        Gasto::create([
            'user_id'=>$user,
            'concepto'=>$concepto,
            'cantidad'=>$cantidad,
            'created_at'=>$fecha,
        ]);
        return redirect()->route('dashboard');
    }

    public function edit(Gasto $gasto){

        return view('gastos.create')->with('gasto',$gasto);
    }

    public function update(Request $request, Gasto $gasto){
        $concepto=$request->get('concepto');
        $cantidad=$request->get('cantidad');
        $fecha=$request->get('fecha');
        $user_id=auth()->user()->id;
        $this->authorize('autorizacion',$gasto);
        $gasto->update([
            'user_id'=>$user_id,
            'concepto'=>$concepto,
            'cantidad'=>$cantidad,
            'created_at'=>$fecha,
        ]);
        
        return redirect()->route('dashboard');
    }

    public function delete(Gasto $gasto){
        $this->authorize('autorizacion',$gasto);
        $gasto->delete();
        return redirect()->route('dashboard');
    }
}
