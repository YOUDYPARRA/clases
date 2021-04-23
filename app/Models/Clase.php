<?php

namespace App\Models;
use App\Models\alumnos;
use App\Models\Asignatura;
use App\Models\Grupo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\ClaseScope;

class Clase extends Model
{
    use HasFactory;
    protected $table = 'clases';
    protected $fillable=[
        'id_alumno',
        'alumno',
        'id_asignatura',
        'asignatura',
        'id_grupo',
        'grupo',
        'ciclo',
        'observacion',
        'data',
        'equipo',
        'id_profesor',
        'profesor',
        'bandera',
    ];
    protected static function booted()
    {
        static::addGlobalScope(new ClaseScope);
    }
    public function scopeObjAlumno($query,$id){
        return alumnos::findOrFail($id);
    }
    public function scopeObjasignatura($query,$id){
        return Asignatura::findOrFail($id);
    }
    public function scopeObjgrupo($query, $id){
        return Grupo::findOrFail($id);
    }
    public function scopeBuscar($query,$buscar){
        return $query->where('alumno','like','%'.$buscar.'%')
        ->orWhere('grupo','like','%'.$buscar.'%')
        ->orWhere('asignatura','like','%'.$buscar.'%');
    }

}
