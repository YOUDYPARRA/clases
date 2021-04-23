<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\EnclaseScope;

class Enclase extends Model
{
    use HasFactory;
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
        'id_planeacion',
        'periodo',
        'puntos',
        'titulo',
        'fecha',
        'id_clase',
    ];
    protected static function booted()
    {
        static::addGlobalScope(new EnclaseScope);
    }
    public function scopeBuscar($query,$buscar){
        return $query->where('alumno','like','%'.$buscar.'%')
        ->orWhere('grupo','like','%'.$buscar.'%')
        ->orWhere('asignatura','like','%'.$buscar.'%');
    }
}
