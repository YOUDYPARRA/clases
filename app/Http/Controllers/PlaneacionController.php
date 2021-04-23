<?php

namespace App\Http\Controllers;

use App\Models\Planeacion;
use App\Models\Asignatura;
use App\Models\Grupo;
use App\Models\Academico;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
class PlaneacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $arr=$this->obtenPlaneaciones();
        return Inertia::render('Planeaciones',['planeaciones'=>$arr['planeaciones'],
        'asignaturas'=>$arr['asignaturas'],
        'grupos'=>$arr['grupos'],
        'profesores'=>$arr['profesores']
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
            'nombre'=>'required',
            'id_asignatura'=>'required',
            // 'asignatura'=>'required',
            'id_grupo'=>'required',
            // 'grupo'=>'required',
            'id_profesor'=>'required',
            // 'profesor'=>'required',
            // 'equipo'=>'required',
            // 'estatus'=>'required'//PENDIENTE, PLANEADO, VISTO
        ]);
        $obj=$this->obtenRelaciones($request);
        Planeacion::create([
            'nombre'=>$request->nombre,
            'fecha'=>$request->fecha,
            'observacion'=>$request->observacion,
            'equipo'=>$request->equipo,
            'material'=>$request->material,
            'estatus'=>$request->estatus,
            'id_asignatura'=>$request->id_asignatura,
            'asignatura'=>$obj['asignatura'],
            'id_grupo'=>$request->id_grupo,
            'grupo'=>$obj['grupo'],
            'id_profesor'=>$request->id_profesor,
            'profesor'=>$obj['profesor'],
        ]);
        return redirect()->back()->with('message', 'Elemento Agregado');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Planeacion  $planeacion
     * @return \Illuminate\Http\Response
     */
    public function show(Planeacion $planeacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Planeacion  $planeacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Planeacion $planeacion)
    {
        //

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Planeacion  $planeacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Planeacion $planeacion)
    {
        //
        $request->validate([
            'nombre'=>'required',
            'id_asignatura'=>'required',
            'id_grupo'=>'required',
            'id_profesor'=>'required',
            'equipo'=>'required',
            'estatus'=>'required'//PENDIENTE, PLANEADO, VISTO
        ]);
        $obj=$this->obtenRelaciones($request);
        $planeacion->nombre=$request->nombre;
        $planeacion->fecha=$request->fecha;
        $planeacion->observacion=$request->observacion;
        $planeacion->id_asignatura=$request->id_asignatura;
        $planeacion->asignatura=$obj['asignatura'];
        $planeacion->id_grupo=$request->id_grupo;
        $planeacion->grupo=$obj['grupo'];
        $planeacion->id_profesor=$request->id_profesor;
        $planeacion->profesor=$obj['profesor'];
        $planeacion->equipo=$request->equipo;
        $planeacion->material=$request->material;
        $planeacion->estatus=$request->estatus;
        $planeacion->save();
        return redirect()->back()->with('message', 'Elemento Actualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Planeacion  $planeacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Planeacion $planeacion)
    {
        Planeacion::findOrFail($request->id)->delete();
        return redirect()->back()->with('message', 'Planeacion  eliminada');
    }
    private function obtenPlaneaciones(){
        $planeaciones=Planeacion::all();
        $asignaturas=Asignatura::asignaturas()->get();
        $grupos=Grupo::grupos()->get();
        $profesores=Academico::academicos()->get();
        return ['planeaciones'=>$planeaciones,
                'asignaturas'=>$asignaturas,
                'grupos'=>$grupos,
                'profesores'=>$profesores,
                ];
    }
    private function obtenRelaciones($r){
        $profesor=Academico::findOrFail($r->id_profesor);
        $grupo=Grupo::findOrFail($r->id_grupo);
        $asignatura=Asignatura::findOrFail($r->id_asignatura);
        return [
            'profesor'=>$profesor->nombre,
            'grupo'=>$grupo->nombre,
            'asignatura'=>$asignatura->asignatura,
        ];
    }
}
