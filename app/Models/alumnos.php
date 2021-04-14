<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class alumnos extends Model
{
    use HasFactory;
    protected $table = 'alumnos';
    protected $fillable=['nombre',
    'apellido_paterno',
    'apellido_materno',
    'fecha_nacimiento',
    'equipo',
    'observacion',
    'correo',
    'bandera',
];
    
    public function scopeNombre($query,$nombre){
        return $query->where('nombre', 'like', '%'.$nombre.'%');
    }
}
