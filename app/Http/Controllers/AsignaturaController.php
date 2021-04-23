<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Asignaturas',['asignaturas'=>$this->obtenAsignaturas()]);
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
            'asignatura'=>'required',
            'equipo'=>'required',
            ]);
            $request->observacion=empty($request->observacion)?'':$request->observacion;
            Asignatura::create([
                'asignatura'=>$request->asignatura,
                'equipo'=>$request->equipo,
                'observacion'=>$request->observacion
                ]);
        return Inertia::render('Asignaturas',['asignaturas'=>$this->obtenAsignaturas()]);
    }
            
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function show(Asignatura $asignatura)
    {
        //

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function edit(Asignatura $asignatura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asignatura $asignatura)
    {
        //
        $request->validate([
            'asignatura'=>'required',
            'equipo'=>'required',
            ]);
            $asignatura->asignatura=$request->asignatura;
            $asignatura->equipo=$request->equipo;
            $asignatura->save();
            return redirect()->back()->with('success', 'Yay it worked');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Asignatura  $asignatura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asignatura $asignatura)
    {
        //Verificar tablas relacionadas antes de eliminar
        $asignatura->delete();
        return redirect()->back()->with('message', 'Elemento eliminado');
    }
    private function obtenAsignaturas(){
        return Asignatura::where('id','>',0)
        // ->where('bandera','Alumno')
        ->orderBy('id','desc')->get();

    }
}
