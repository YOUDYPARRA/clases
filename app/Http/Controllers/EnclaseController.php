<?php

namespace App\Http\Controllers;

use App\Models\Enclase;
use App\Models\Clase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class EnclaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        dd('nada');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->all());
        $grupo=Clase::where('grupo',$request->grupo)->get();
        return Inertia::render('EnclaseCrear',
        [
            'grupo'=>$request->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'id_alumno'=>'required',
            'id_asignatura'=>'required',
            'id_grupo'=>'required',
            'equipo'=>'required',
            'bandera'=>'required',
            'periodo'=>'required',
            'puntos'=>'required',
            'titulo'=>'required',
            'fecha'=>'required',
            'id_clase'=>'required',
        ]);
        $sesion = new Sesion();
        $sesion->id_alumno=$request->id_alumno;
        $sesion->alumno=$request->alumno;
        $sesion->id_asignatura=$request->id_asignatura;
        $sesion->asignatura=$request->asignatura;
        $sesion->id_grupo=$request->id_grupo;
        $sesion->grupo=$request->grupo;
        $sesion->ciclo=$request->ciclo;
        $sesion->observacion=$request->observacion;
        $sesion->data=$request->data;
        $sesion->equipo=$request->equipo;
        $sesion->id_profesor=$request->id_profesor;
        $sesion->profesor=$request->profesor;
        $sesion->bandera=$request->bandera;
        $sesion->id_planeacion=$request->id_planeacion;
        $sesion->periodo=$request->periodo;
        $sesion->puntos=$request->puntos;
        $sesion->titulo=$request->titulo;
        $sesion->fecha=$request->fecha;
        $sesion->id_clase=$request->id_clase;
        $sesion->save();
        return redirect()->back()->with('message', 'Elemento Guardado');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enclase  $enclase
     * @return \Illuminate\Http\Response
     */
    public function show(Enclase $enclase)
    {
        //
        $sesion=Sesion::findOrFail($sesion->id);
        return Inertia::render('Enclase',['sesion'=>$sesion]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enclase  $enclase
     * @return \Illuminate\Http\Response
     */
    public function edit(Enclase $enclase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enclase  $enclase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Enclase $enclase)
    {
        $request->validate([
            'id_alumno'=>'required',
            'id_asignatura'=>'required',
            'id_grupo'=>'required',
            'equipo'=>'required',
            'bandera'=>'required',
            'periodo'=>'required',
            'puntos'=>'required',
            'titulo'=>'required',
            'fecha'=>'required',
            'id_clase'=>'required',
        ]);
        $sesion=Sesion::findOrFail($sesion->id);
        $sesion->id_alumno=$request->id_alumno;
        $sesion->alumno=$request->alumno;
        $sesion->id_asignatura=$request->id_asignatura;
        $sesion->asignatura=$request->asignatura;
        $sesion->id_grupo=$request->id_grupo;
        $sesion->grupo=$request->grupo;
        $sesion->ciclo=$request->ciclo;
        $sesion->observacion=$request->observacion;
        $sesion->data=$request->data;
        $sesion->equipo=$request->equipo;
        $sesion->id_profesor=$request->id_profesor;
        $sesion->profesor=$request->profesor;
        $sesion->bandera=$request->bandera;
        $sesion->id_planeacion=$request->id_planeacion;
        $sesion->periodo=$request->periodo;
        $sesion->puntos=$request->puntos;
        $sesion->titulo=$request->titulo;
        $sesion->fecha=$request->fecha;
        $sesion->id_clase=$request->id_clase;
        $sesion->save();
        return redirect()->back()->with('success_message', 'Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enclase  $enclase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enclase $enclase)
    {
        //
        $sesion->destroy();
        return redirect()->back()->with('success_message', 'Eliminado');
    }
}
