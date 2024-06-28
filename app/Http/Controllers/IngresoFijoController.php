<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IngresoFijo;


class IngresoFijoController extends Controller
{
    public function list(){
        $user=auth()->user()->id;
        $ingresosfijos=IngresoFijo::where('user_id',$user)->get();
        return view('ingresosFijos.list')->with('ingresosFijos',$ingresosfijos);
    }

    public function create(){

        return view('ingresosFijos.create_or_edit');
    }

    public function edit(IngresoFijo $ingreso){

        return view('ingresosFijos.create_or_edit')->with('ingreso',$ingreso);
    }

    public function save(Request $request){
        $concepto=$request->post('concepto');
        $cantidad=$request->post('cantidad');
        $user_id=auth()->user()->id;
        IngresoFijo::create([
            'user_id'=>$user_id,
            'concepto'=>$concepto,
            'cantidad'=>$cantidad
        ]);
        
        return redirect()->route('ingresosFijos.list');
    }

    public function update(Request $request, IngresoFijo $ingreso){
        $concepto=$request->get('concepto');
        $cantidad=$request->get('cantidad');
        $user_id=auth()->user()->id;
        $this->authorize('update',$ingreso);
        $ingreso->update([
            'user_id'=>$user_id,
            'concepto'=>$concepto,
            'cantidad'=>$cantidad
        ]);
        
        return redirect()->route('ingresosFijos.list');
    }

    public function delete(IngresoFijo $ingreso){
        $this->authorize('delete',$ingreso);
        $ingreso->delete();
        return redirect()->route('ingresosFijos.list');
    }

}