<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GastoFijo;

class GastoFijoController extends Controller
{
    public function list(){

        $user=auth()->user()->id;
        $gastosfijos=GastoFijo::where('user_id',$user)->get();
        return view('gastosFijos.list')->with('gastosFijos',$gastosfijos);
    }

    public function create(){

        return view('gastosFijos.create_or_edit');
    }

    public function edit(GastoFijo $gasto){

        return view('gastosFijos.create_or_edit')->with('gasto',$gasto);
    }

    public function save(Request $request){
        $concepto=$request->post('concepto');
        $cantidad=$request->post('cantidad');
        $user_id=auth()->user()->id;
        GastoFijo::create([
            'user_id'=>$user_id,
            'concepto'=>$concepto,
            'cantidad'=>$cantidad
        ]);
        
        return redirect()->route('gastosFijos.list');
    }

    public function update(Request $request, GastoFijo $gasto){
        $concepto=$request->get('concepto');
        $cantidad=$request->get('cantidad');
        $user_id=auth()->user()->id;
        $this->authorize('update',$gasto);
        $gasto->update([
            'user_id'=>$user_id,
            'concepto'=>$concepto,
            'cantidad'=>$cantidad
        ]);
        
        return redirect()->route('gastosFijos.list');
    }

    public function delete(GastoFijo $gasto){
        $this->authorize('delete',$gasto);
        $gasto->delete();
        return redirect()->route('gastosFijos.list');
    }

}

