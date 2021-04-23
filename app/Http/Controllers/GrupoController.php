<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class GrupoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Inertia::render('Grupos',['grupos'=>$this->obtenGrupos()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nombre'=>'required',
            'grado'=>'required',
            'letra'=>'required',
            'equipo'=>'required',
            'ciclo'=>'required',
        ]);
        Grupo::create([
            'nombre'=>$request->nombre,
            'grado'=>$request->grado,
            'letra'=>$request->letra,
            'turno'=>$request->turno,
            'observacion'=>$request->observacion,
            'data'=>$request->data,
            'equipo'=>$request->equipo,
            'ciclo'=>$request->ciclo,
        ]);
        return Inertia::render('Grupos',['grupos'=>$this->obtenGrupos()]);
        // return redirect()->back()->with('message', 'Elemento almacenado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function show(Grupo $grupo)
    {
        //
        return Inertia::render('Grupos',['grupos'=>$this->obtenGrupos()]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function edit(Grupo $grupo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Grupo $grupo)
    {
        //
        $request->validate([
            'nombre'=>'required',
            'grado'=>'required',
            'letra'=>'required',
            'equipo'=>'required',
            'ciclo'=>'required',
        ]);
        $grupo->nombre=$request->nombre;
        $grupo->grado=$request->grado;
        $grupo->letra=$request->letra;
        $grupo->turno=$request->turno;
        $grupo->observacion=$request->observacion;
        $grupo->data=$request->data;
        $grupo->equipo=$request->equipo;
        $grupo->ciclo=$request->ciclo;
        $grupo->save();
        return Inertia::render('Grupos',['grupos'=>$this->obtenGrupos()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Grupo  $grupo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Grupo $grupo)
    {
        //
        Log::debug($grupo);
        $grupo->delete();
        return redirect()->back()->with('message', 'Elemento eliminado');
    }
    private function obtenGrupos(){
        return Grupo::where('id','>',0)
        // ->where('bandera','Alumno')
        ->orderBy('id','desc')->get();
    }
}
