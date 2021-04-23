<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asignatura extends Model
{
    use HasFactory;
    protected $table = 'asignaturas';
    protected $fillable=[
        'asignatura',
        'observacion',
        'data',
        'equipo'
    ];
    public function scopeAsignaturas($query)
    {
        return $query->where('id', '>', 0);
    }
}
