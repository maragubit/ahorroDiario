<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingreso;

class IngresoController extends Controller
{
    
    public function list()
    {
        return view ('ingresos.list');
    }

    public function listFilter(Request $request)
    {
        $user=auth()->user()->id;
        $fechaIni=$request->post('fechaIni');
        $fechaFin=$request->post('fechaFin');
        $ingresos=Ingreso::where('user_id',$user)->whereBetween('created_at', [$fechaIni, $fechaFin])->get();
        return view ('ingresos.listFilter')->with('ingresos',$ingresos);
    }
    
    
    public function create(){

        return view ('ingresos.create');
    }

    public function save(Request $request){
        $concepto=$request->post('concepto');
        $cantidad=$request->post('cantidad');
        $fecha=$request->post('fecha');
        $user=auth()->user()->id;
        Ingreso::create([
            'user_id'=>$user,
            'concepto'=>$concepto,
            'cantidad'=>$cantidad,
            'created_at'=>$fecha,
        ]);
        return redirect()->route('dashboard');
    }

    public function edit(Ingreso $ingreso){

        return view('create')->with('ingreso',$ingreso);
    }

    public function update(Request $request, Ingreso $ingreso){
        $concepto=$request->get('concepto');
        $cantidad=$request->get('cantidad');
        $fecha=$request->get('fecha');
        $user_id=auth()->user()->id;
        $this->authorize('autorizacion',$ingreso);
        $ingreso->update([
            'user_id'=>$user_id,
            'concepto'=>$concepto,
            'cantidad'=>$cantidad,
            'created_at'=>$fecha,
        ]);
        
        return redirect()->route('dashboard');
    }

    public function delete(Ingreso $ingreso){
        $this->authorize('autorizacion',$ingreso);
        $ingreso->delete();
        return redirect()->route('dashboard');
    }
}
