<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use App\Models\Asignatura;
use Illuminate\Support\Facades\Log;
// use App\Models\Academico;
use App\Models\Grupo;
// use App\Helpers\helper;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ClaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $grupos=listar_grupos();
        // $alumnos=listar_alumnos();
        $asignaturas=listar_asignaturas();
        // dd($asignaturas);
        // $grupos=helper::obtener_grupos();
        return Inertia::render('Clases',
        [
            'clases'=>Clase::all(),
            'grupos'=>$grupos,
            'asignaturas'=>$asignaturas,
            // 'alumnos'=>$alumnos,
        // 'profesores'=>$arr['profesores']
        
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
            'id_alumno'=>'required',
            'id_asignatura'=>'required',
            'id_grupo'=>'required',
            'equipo'=>'required',
            'bandera'=>'required',
        ]);
        // dd($request->id_alumno);
        // Log::debug($request->id_alumno);
        $clase=$this->crear_clase($request);
        // Log::debug($clase->id);
        // Log::debug($clase->id);
        if(is_numeric($clase->id)){
            return redirect()->back()->with('message', 'Elemento guardo correctamente');
        }
        return redirect()->back()->with('message', 'Falló al guardar.');
        
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $clase = new Clase();
        $clases=$clase->buscar($request->buscar)->get();

        return Inertia::render('Clases',['clases'=>$clases]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function edit(Clase $clase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clase $clase)
    {
        //
        // $request->validate([
        //     'id_alumno'=>'required',
        //     'id_asignatura'=>'required',
        //     'id_grupo'=>'required',
        //     'equipo'=>'required',
        //     'bandera'=>'required',
        // ]);
        $clase->delete();
        $clase_creada=$this->crear_clase($request);
        return redirect()->back()->with('message', 'Elemento Modificado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clase  $clase
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clase $clase)
    {
        $clase->delete();
        return redirect()->back()->with('message', 'Elemento Eliminado');
    }
    private function crear_clase($request){
        $clase_creada=null;
        foreach ($request->id_alumno as $key => $obj_alumno) {
            $clase = new Clase();
            $obj_grupo=$clase->objgrupo($request->id_grupo);
            $obj_asignatura=$clase->objasignatura($request->id_asignatura);
            
            $clase->grupo=$obj_grupo->nombre;
            $clase->id_grupo=$request->id_grupo;
            $clase->ciclo=$obj_grupo->ciclo;

            $clase->id_alumno=$obj_alumno['id'];
            $clase->alumno=$obj_alumno['nombre'] .' '.$obj_alumno['apellido_paterno'].' '. $obj_alumno['apellido materno'];

            $clase->id_asignatura=$request->id_asignatura;
            $clase->asignatura=$obj_asignatura->asignatura;

            $clase->observacion=$request->observacion;
            $clase->bandera=$request->bandera;
            $clase->equipo=$request->equipo;
            $clase_creada=$clase->save();
        }
        return $clase_creada;

    }
    
}
