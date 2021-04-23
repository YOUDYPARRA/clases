<?php

namespace App\Http\Controllers;

use App\Models\Academico;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AcademicoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
        return Inertia::render('Academicos',['academicos'=>
        $this->obntenAcademicos()
        ]);
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
            'apellido_paterno'=>'required | min:2',
            'nombre'=>'required | min:2',
            'apellido_materno'=>'required | min:2',
            'fecha_nacimiento'=>'required',
            'equipo'=>'required | min:2',
            'observacion'=>'required | min:2',
            'bandera'=>'required',
            'correo'=>'required'

        ]);
        Academico::create([
            'nombre'=>$request->nombre,
            'apellido_paterno'=>$request->apellido_paterno,
            'apellido_materno'=>$request->apellido_materno,
            'id_grupo'=>$request->id_grupo,
            'fecha_nacimiento'=>$request->fecha_nacimiento,
            'equipo'=>$request->equipo,
            'observacion'=>$request->observacion,
            'correo'=>$request->correo,
            'bandera'=>$request->bandera,
        ]);
        return Inertia::render('Academicos',['academicos'=>
        $this->obntenAcademicos()
        ]);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Academico  $academico
     * @return \Illuminate\Http\Response
     */
    public function show(Academico $academico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Academico  $academico
     * @return \Illuminate\Http\Response
     */
    public function edit(Academico $academico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Academico  $academico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Academico $academico)
    {
        //
        $request->validate([
            'apellido_paterno'=>'required | min:2',
            'nombre'=>'required | min:2',
            'apellido_materno'=>'required | min:2',
            'fecha_nacimiento'=>'required',
            'equipo'=>'required | min:2',
            'observacion'=>'required | min:2',
            'bandera'=>'required',
            'correo'=>'required'

        ]);
            // Log::debug('Update academico '.$academico);
        $academico->apellido_paterno=$request->apellido_paterno;
        $academico->nombre=$request->nombre;
        $academico->apellido_materno=$request->apellido_materno;
        $academico->id_grupo=$request->id_grupo;
        $academico->fecha_nacimiento=$request->fecha_nacimiento;
        $academico->equipo=$request->equipo;
        $academico->observacion=$request->observacion;
        $academico->correo=$request->correo;
        $academico->bandera=$request->bandera;
        $academico->save();
        return redirect()->back()->with('success_message', 'Yay it worked');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Academico  $academico
     * @return \Illuminate\Http\Response
     */
    public function destroy(Academico $academico)
    {
        //
        $academico->delete();
        return redirect()->back()->with('message', 'Elemento eliminado');
    }
    private function obntenAcademicos(){
        return Academico::where('id','>',0)
        ->where('bandera','<>','Alumno')
        ->orderBy('id','desc')->get();
    }
    
}
