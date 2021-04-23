<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academico extends Model
{
    use HasFactory;
    protected $table = 'alumnos';
    protected $fillable=['nombre',
    'apellido_paterno',
    'apellido_materno',
    'fecha_nacimiento',
    'equipo',
    'observacion',//telefono
    'correo',
    'bandera',// Maestro
    'id_grupo'];
    public function scopeAcademicos($query)
    {
        return $query->where('id', '>', 0)->where('bandera','Maestro');
    }
}

