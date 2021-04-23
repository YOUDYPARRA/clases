<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    use HasFactory;
    protected $table = 'grupos';
    protected $fillable=[
        'nombre',
        'grado',
        'letra',
        'turno',
        'observacion',
        'data',
        'equipo',
        'ciclo',
    ];
    public function scopeGrupos($query)
    {
        return $query->where('id', '>', 0);
    }
}
